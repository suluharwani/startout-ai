<?php
declare(strict_types=1);

namespace App\Core;

use PDO;

/**
 * Installs the database schema and seed content.
 * All operations are idempotent — safe to run on every boot.
 */
final class Installer
{
    private const TABLES = [
        'settings',
        'pages',
        'services',
        'testimonials',
        'team_members',
        'jobs',
        'faqs',
        'contact_messages',
        'users',
    ];

    public static function ensure(PDO $pdo): void
    {
        self::createTables($pdo);
        self::seedSettings($pdo);
        self::seedPages($pdo);
        self::seedServices($pdo);
        self::seedTestimonials($pdo);
        self::seedTeam($pdo);
        self::seedJobs($pdo);
        self::seedFaqs($pdo);
        // NOTE: no default admin is seeded — the first visitor registers one
        // via /admin/register when the `users` table is empty.
    }

    public static function isInstalled(PDO $pdo): bool
    {
        try {
            foreach (self::TABLES as $table) {
                $pdo->query("SELECT 1 FROM `{$table}` LIMIT 1");
            }
            return true;
        } catch (\Throwable) {
            return false;
        }
    }

    /* ─────────────────────────── Schema ─────────────────────────── */

    private static function createTables(PDO $pdo): void
    {
        $sql = "
        CREATE TABLE IF NOT EXISTS `settings` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `setting_key` VARCHAR(100) NOT NULL,
            `setting_value` LONGTEXT NULL,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            UNIQUE KEY `uq_settings_key` (`setting_key`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

        CREATE TABLE IF NOT EXISTS `pages` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `slug` VARCHAR(120) NOT NULL,
            `title` VARCHAR(255) NOT NULL,
            `subtitle` TEXT NULL,
            `content` LONGTEXT NULL,
            `meta_title` VARCHAR(255) NULL,
            `meta_description` TEXT NULL,
            `is_active` TINYINT(1) NOT NULL DEFAULT 1,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            UNIQUE KEY `uq_pages_slug` (`slug`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

        CREATE TABLE IF NOT EXISTS `services` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `slug` VARCHAR(120) NOT NULL,
            `name` VARCHAR(255) NOT NULL,
            `tagline` VARCHAR(255) NULL,
            `short_description` TEXT NULL,
            `description` LONGTEXT NULL,
            `icon` VARCHAR(100) NULL,
            `image` VARCHAR(255) NULL,
            `featured` TINYINT(1) NOT NULL DEFAULT 0,
            `is_active` TINYINT(1) NOT NULL DEFAULT 1,
            `sort_order` INT NOT NULL DEFAULT 0,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            UNIQUE KEY `uq_services_slug` (`slug`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

        CREATE TABLE IF NOT EXISTS `testimonials` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL,
            `role` VARCHAR(255) NULL,
            `company` VARCHAR(255) NULL,
            `content` TEXT NULL,
            `image` VARCHAR(255) NULL,
            `is_active` TINYINT(1) NOT NULL DEFAULT 1,
            `sort_order` INT NOT NULL DEFAULT 0,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

        CREATE TABLE IF NOT EXISTS `team_members` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL,
            `position` VARCHAR(255) NULL,
            `bio` TEXT NULL,
            `photo` VARCHAR(255) NULL,
            `linkedin` VARCHAR(255) NULL,
            `is_active` TINYINT(1) NOT NULL DEFAULT 1,
            `sort_order` INT NOT NULL DEFAULT 0,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

        CREATE TABLE IF NOT EXISTS `jobs` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `title` VARCHAR(255) NOT NULL,
            `category` VARCHAR(100) NULL,
            `location` VARCHAR(255) NULL,
            `type` VARCHAR(100) NULL,
            `description` TEXT NULL,
            `is_active` TINYINT(1) NOT NULL DEFAULT 1,
            `sort_order` INT NOT NULL DEFAULT 0,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

        CREATE TABLE IF NOT EXISTS `faqs` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `question` TEXT NOT NULL,
            `answer` TEXT NULL,
            `is_active` TINYINT(1) NOT NULL DEFAULT 1,
            `sort_order` INT NOT NULL DEFAULT 0,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

        CREATE TABLE IF NOT EXISTS `contact_messages` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `first_name` VARCHAR(100) NULL,
            `last_name` VARCHAR(100) NULL,
            `email` VARCHAR(255) NULL,
            `company` VARCHAR(255) NULL,
            `phone` VARCHAR(50) NULL,
            `service` VARCHAR(255) NULL,
            `message` TEXT NULL,
            `is_read` TINYINT(1) NOT NULL DEFAULT 0,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

        CREATE TABLE IF NOT EXISTS `users` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL,
            `email` VARCHAR(255) NOT NULL,
            `password` VARCHAR(255) NOT NULL,
            `role` ENUM('admin','super_admin') NOT NULL DEFAULT 'admin',
            `is_active` TINYINT(1) NOT NULL DEFAULT 1,
            `last_login` DATETIME NULL,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            UNIQUE KEY `uq_users_email` (`email`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";

        $pdo->exec($sql);
    }

    /* ─────────────────────────── Seeders ─────────────────────────── */

    private static function seedSettings(PDO $pdo): void
    {
        $count = (int) $pdo->query('SELECT COUNT(*) FROM settings')->fetchColumn();
        if ($count > 0) {
            return;
        }

        $defaults = [
            'company_name'           => 'Motrive',
            'company_logo_text'      => 'Motrive',
            'company_logo'           => '',
            'company_favicon'        => '',
            'company_tagline'        => 'Full-service remote operations for ambitious brands',
            'company_email'          => 'hi@startoutai.com',
            'company_phone'          => '628602268666',
            'company_whatsapp'       => '628602268666',
            'company_address'        => 'Yogyakarta, Indonesia',
            'company_city'           => 'Yogyakarta',
            'company_country'        => 'Indonesia',
            'company_linkedin'       => 'https://www.linkedin.com/company/startout-ai/',
            'company_x'              => 'https://x.com/startoutai',
            'company_facebook'       => 'https://www.facebook.com/startoutai',
            'company_instagram'      => 'https://www.instagram.com/startoutai',
            'company_description'    => 'Motrive is a full-service remote operations partner. We build, manage and scale dedicated remote teams for customer experience, data annotation, trust & safety, talent and content moderation.',
            'hero_title'             => 'Remote Operations, Built Around You',
            'hero_subtitle'          => 'Achieve KPIs, scale support, nurture trust and unify communities, while trimming costs. Motrive makes it effortless.',
            'hero_button_text'       => 'Start Your Journey',
            'hero_button_link'       => '/contact',
            'home_intro_kicker'      => 'Who We Are',
            'home_intro_title'       => 'Your Dedicated Remote Operations Partner',
            'home_intro_text'        => 'Motrive builds and manages dedicated remote teams that keep your operations running — around the clock, at any scale. We handle the people, the processes and the quality so you can focus on growing your business.',
            'about_heading'          => 'A Partner for Your Remote Operations',
            'about_text'             => 'Motrive is a full-service remote operations company. We build, manage and scale dedicated teams that handle the day-to-day work behind ambitious brands — support, data, safety, talent and more.',
            'footer_about'           => 'We build and manage dedicated remote teams that help ambitious brands deliver exceptional operations, at any scale, anywhere in the world.',
            'copyright_text'         => '© {year} Motrive. All rights reserved.',
            'schedule_wa_message'    => 'Hi Motrive, I would like to schedule a consultation.',
            'jobs_feed_url'          => '',
        ];

        $stmt = $pdo->prepare(
            'INSERT INTO settings (setting_key, setting_value) VALUES (:key, :value)'
        );

        foreach ($defaults as $key => $value) {
            $stmt->execute(['key' => $key, 'value' => $value]);
        }
    }

    private static function seedPages(PDO $pdo): void
    {
        $count = (int) $pdo->query('SELECT COUNT(*) FROM pages')->fetchColumn();
        if ($count > 0) {
            return;
        }

        $pages = [
            [
                'slug'              => 'about',
                'title'             => 'Your Trusted Remote Operations Partner',
                'subtitle'          => 'Our story, our mission and the team behind Motrive.',
                'content'           => '<p>Motrive is a full-service remote operations company. We build, manage and scale dedicated teams that keep ambitious brands running smoothly — customer experience, data annotation, trust &amp; safety, talent solutions, community and more.</p><p>We are proudly remote-first and fully outsourced. Our teams work as a natural extension of yours, with the processes, training and quality controls to deliver consistent results around the clock.</p>',
                'meta_title'        => 'About Us',
                'meta_description'  => 'Learn about Motrive — our story, mission and values.',
                'is_active'         => 1,
            ],
            [
                'slug'              => 'resources',
                'title'             => 'Guides, Insights & Case Studies',
                'subtitle'          => 'Practical thinking on remote operations, customer experience, trust & safety and modern work.',
                'content'           => '<h3>The Remote Operations Playbook</h3><p>How to design a remote operation that scales quality, not just volume. People, tooling, QA and reporting — built to grow with you.</p><h3>Content Moderation as a Growth Engine</h3><p>Moderation is often treated as a cost center. This case study shows how a unified trust &amp; safety program became a retention driver for a global social platform.</p><h3>Launching CX in 30 Days</h3><p>A step-by-step guide to ramping a fully-staffed customer experience operation — people, tooling, QA and reporting — in under a month.</p>',
                'meta_title'        => 'Resources',
                'meta_description'  => 'Guides, case studies and insights from Motrive.',
                'is_active'         => 1,
            ],
        ];

        $stmt = $pdo->prepare(
            'INSERT INTO pages
                (slug, title, subtitle, content, meta_title, meta_description, is_active)
             VALUES
                (:slug, :title, :subtitle, :content, :meta_title, :meta_description, :is_active)'
        );

        foreach ($pages as $page) {
            $stmt->execute($page);
        }
    }

    private static function seedServices(PDO $pdo): void
    {
        $count = (int) $pdo->query('SELECT COUNT(*) FROM services')->fetchColumn();
        if ($count > 0) {
            return;
        }

        $services = self::serviceData();

        $stmt = $pdo->prepare(
            'INSERT INTO services
                (slug, name, tagline, short_description, description, icon, featured, is_active, sort_order)
             VALUES
                (:slug, :name, :tagline, :short_description, :description, :icon, :featured, 1, :sort_order)'
        );

        foreach ($services as $index => $service) {
            $stmt->execute([
                'slug'             => $service['slug'],
                'name'             => $service['name'],
                'tagline'          => $service['tagline'],
                'short_description'=> $service['short_description'],
                'description'      => $service['description'],
                'icon'             => $service['icon'],
                'featured'         => $service['featured'],
                'sort_order'       => $index + 1,
            ]);
        }
    }

    /**
     * Rich seed content for every service page referenced on the site.
     */
    private static function serviceData(): array
    {
        return [
            [
                'slug'   => 'data-annotation',
                'name'   => 'Data Annotation',
                'tagline' => 'Accurate, scalable data services, delivered on time.',
                'icon'   => 'fa-solid fa-bullseye',
                'featured' => 0,
                'short_description' => 'Precise data annotation and labeling handled by specialists who understand the detail.',
                'description' => '<p>Every data-driven system begins with quality data. Motrive\'s Data Annotation practice delivers precise, scalable annotation and labeling services built by specialists who understand the detail.</p><p>Our teams combine rigorous QA with domain expertise to keep your pipelines accurate and consistent — annotation, labeling and data preparation, all at scale.</p><ul><li>Image, video, text &amp; audio annotation</li><li>Data labeling &amp; preparation</li><li>Quality review &amp; validation</li><li>Multi-language and domain-specific labeling</li></ul>',
            ],
            [
                'slug'   => 'trust-safety',
                'name'   => 'Trust & Safety',
                'tagline' => 'Protect your platform, community and brand — 24/7.',
                'icon'   => 'fa-solid fa-shield-halved',
                'featured' => 0,
                'short_description' => 'End-to-end trust, safety and content moderation as a single, unified program.',
                'description' => '<p>Trust &amp; Safety covers the full lifecycle of keeping your platform safe: proactive content moderation, community management, policy tuning and crisis response.</p><p>Motrive runs a proven moderation operating model. Our expert teams shield your brand and your users from harmful content around the clock, following your policies with consistency and care.</p><ul><li>Content moderation at scale (text, image, video, audio)</li><li>Community management &amp; policy operations</li><li>Escalations, appeals &amp; crisis response</li><li>Data, security &amp; compliance controls</li></ul>',
            ],
            [
                'slug'   => 'talent-solution',
                'name'   => 'Talent Solution',
                'tagline' => 'The right people, at the right time, ready to perform.',
                'icon'   => 'fa-solid fa-user-group',
                'featured' => 0,
                'short_description' => 'Flexible, vetted teams of remote operations specialists.',
                'description' => '<p>Scale your operations without the overhead. Our Talent Solution gives you access to vetted, trained specialists who embed into your workflow and start delivering from day one.</p><p>Whether you need frontline support, data specialists or community managers, we recruit, train and manage the talent so you can focus on the outcome.</p><ul><li>Dedicated &amp; on-demand staffing</li><li>Industry-specific training programs</li><li>Performance management &amp; QA</li><li>Seamless ramp-up and handover</li></ul>',
            ],
            [
                'slug'   => 'social-media',
                'name'   => 'Social Media',
                'tagline' => 'Always-on social care that keeps communities buzzing.',
                'icon'   => 'fa-solid fa-hashtag',
                'featured' => 0,
                'short_description' => 'Moderation, engagement and community management for the world\'s biggest platforms.',
                'description' => '<p>Social media never sleeps — and neither do we. Motrive manages your social care operations end-to-end: moderation, engagement, brand protection and community growth.</p><p>Our teams combine cultural fluency with platform expertise to keep conversations safe, on-brand and human.</p><ul><li>24/7 social moderation &amp; engagement</li><li>Community management &amp; growth</li><li>Brand safety &amp; crisis monitoring</li><li>Reporting &amp; sentiment analytics</li></ul>',
            ],
            [
                'slug'   => 'gaming-entertainment',
                'name'   => 'Gaming & Entertainment',
                'tagline' => 'Player experience that keeps gamers playing.',
                'icon'   => 'fa-solid fa-gamepad',
                'featured' => 1,
                'short_description' => 'Player support, moderation and community care built for the world of gaming.',
                'description' => '<p>Great games deserve great player experiences. Motrive powers support, moderation and community programs for gaming and entertainment brands worldwide.</p><p>From in-game ticketing to live-ops moderation, our specialists are fluent in the culture and cadence of modern players.</p><ul><li>Player support &amp; live-ops care</li><li>In-game moderation &amp; anti-toxicity</li><li>Community &amp; creator programs</li><li>UGC review &amp; ratings curation</li></ul>',
            ],
            [
                'slug'   => 'fintech-banking',
                'name'   => 'Fintech & Banking',
                'tagline' => 'Compliant customer care for the new world of money.',
                'icon'   => 'fa-solid fa-building-columns',
                'featured' => 1,
                'short_description' => 'Secure, compliant support and dispute resolution for financial services.',
                'description' => '<p>Financial services demand precision, security and trust. Motrive delivers compliant customer care and operations for fintech, banking and payments brands.</p><p>Our specialists are trained on regulatory nuance, fraud prevention and data security, so every interaction protects your customers and your reputation.</p><ul><li>Multi-channel customer care</li><li>Fraud &amp; dispute resolution</li><li>KYC/AML operations support</li><li>Secure data handling &amp; compliance</li></ul>',
            ],
            [
                'slug'   => 'ecommerce-retail',
                'name'   => 'E-commerce & Retail',
                'tagline' => 'Shopping experiences customers love — and return to.',
                'icon'   => 'fa-solid fa-cart-shopping',
                'featured' => 1,
                'short_description' => 'Order support, CX and marketplace operations that convert and retain.',
                'description' => '<p>From cart to doorstep, Motrive keeps e-commerce and retail experiences fast, friendly and frictionless.</p><p>We power order support, marketplace operations and customer experience programs that lift conversion, CSAT and retention — during peak and beyond.</p><ul><li>Order &amp; delivery support</li><li>Marketplace &amp; seller operations</li><li>Returns, refunds &amp; escalations</li><li>Peak-season surge capacity</li></ul>',
            ],
            [
                'slug'   => 'process-automation',
                'name'   => 'Process Automation',
                'tagline' => 'Repetitive work, automated. People, amplified.',
                'icon'   => 'fa-solid fa-robot',
                'featured' => 0,
                'short_description' => 'Workflow automation and CRM integration that remove friction from your operations.',
                'description' => '<p>Automation that never sleeps and human touch where it matters most. Motrive reimagines your processes with smart automation and people-powered insight working around the clock.</p><p>We streamline your stack with strategic guidance, real-time reporting and hands-on training, so your daily operations never miss a beat.</p><ul><li>Workflow automation &amp; RPA</li><li>CRM &amp; tool integration</li><li>Process optimization &amp; documentation</li><li>Reporting, analytics &amp; continuous tuning</li></ul>',
            ],
        ];
    }

    private static function seedTestimonials(PDO $pdo): void
    {
        $count = (int) $pdo->query('SELECT COUNT(*) FROM testimonials')->fetchColumn();
        if ($count > 0) {
            return;
        }

        $rows = [
            ['Aisha Rahman', 'Head of Operations', 'Global Consumer Platform', 'Motrive scaled our content moderation to millions of items a day without ever compromising on quality. They are a true extension of our team.'],
            ['Daniel Kim', 'VP Customer Experience', 'E-commerce Group', 'Response times dropped by 60% and CSAT is at an all-time high. Their dedicated remote team simply works.'],
            ['Maria Santos', 'Chief Product Officer', 'Fintech Startup', 'Compliant, secure and remarkably responsive. Their financial services team understands our industry better than anyone we have worked with.'],
            ['James Osei', 'Community Director', 'Gaming Studio', 'Player sentiment has never been healthier. Their moderation and community teams are fast, empathetic and culturally spot-on.'],
        ];

        $stmt = $pdo->prepare(
            'INSERT INTO testimonials (name, role, company, content, is_active, sort_order)
             VALUES (:name, :role, :company, :content, 1, :sort_order)'
        );

        foreach ($rows as $i => $row) {
            $stmt->execute([
                'name' => $row[0],
                'role' => $row[1],
                'company' => $row[2],
                'content' => $row[3],
                'sort_order' => $i + 1,
            ]);
        }
    }

    private static function seedTeam(PDO $pdo): void
    {
        $count = (int) $pdo->query('SELECT COUNT(*) FROM team_members')->fetchColumn();
        if ($count > 0) {
            return;
        }

        $rows = [
            ['Alex Johnson', 'CEO & Co-Founder', 'Building dedicated remote teams that deliver.', 'https://www.linkedin.com/company/startout-ai/'],
            ['Sarah Chen', 'Chief Operations Officer', 'Leading our global remote operations.', 'https://www.linkedin.com/company/startout-ai/'],
            ['Michael Rodriguez', 'Chief Delivery Officer', 'Delivering excellence across global remote teams.', 'https://www.linkedin.com/company/startout-ai/'],
            ['Priya Nair', 'VP, Trust & Safety', 'Protecting platforms and communities worldwide.', 'https://www.linkedin.com/company/startout-ai/'],
        ];

        $stmt = $pdo->prepare(
            'INSERT INTO team_members (name, position, bio, linkedin, is_active, sort_order)
             VALUES (:name, :position, :bio, :linkedin, 1, :sort_order)'
        );

        foreach ($rows as $i => $row) {
            $stmt->execute([
                'name' => $row[0],
                'position' => $row[1],
                'bio' => $row[2],
                'linkedin' => $row[3],
                'sort_order' => $i + 1,
            ]);
        }
    }

    private static function seedJobs(PDO $pdo): void
    {
        $count = (int) $pdo->query('SELECT COUNT(*) FROM jobs')->fetchColumn();
        if ($count > 0) {
            return;
        }

        $rows = [
            ['Data Annotation Specialist', 'Operations', 'Remote', 'Full-time', 'Produce and QA accurate, consistent annotation and labeling work for our clients.'],
            ['Trust & Safety Analyst', 'Operations', 'Remote', 'Full-time', 'Moderate content and enforce platform policies with accuracy and empathy.'],
            ['Customer Experience Specialist', 'Operations', 'Remote', 'Full-time', 'Deliver outstanding support across chat, email and social channels.'],
            ['Community Manager', 'Operations', 'Remote', 'Full-time', 'Grow and protect engaged communities for gaming and entertainment brands.'],
            ['Social Media Moderator', 'Operations', 'Remote', 'Full-time', 'Keep social conversations safe, on-brand and human, 24/7.'],
        ];

        $stmt = $pdo->prepare(
            'INSERT INTO jobs (title, category, location, type, description, is_active, sort_order)
             VALUES (:title, :category, :location, :type, :description, 1, :sort_order)'
        );

        foreach ($rows as $i => $row) {
            $stmt->execute([
                'title' => $row[0],
                'category' => $row[1],
                'location' => $row[2],
                'type' => $row[3],
                'description' => $row[4],
                'sort_order' => $i + 1,
            ]);
        }
    }

    private static function seedFaqs(PDO $pdo): void
    {
        $count = (int) $pdo->query('SELECT COUNT(*) FROM faqs')->fetchColumn();
        if ($count > 0) {
            return;
        }

        $rows = [
            ['How does Motrive build and manage remote teams?', 'We recruit, train and manage dedicated remote teams that operate as a natural extension of yours. From onboarding to QA to reporting, we handle the people and the process so you can focus on outcomes.'],
            ['Which industries do you specialize in?', 'We serve gaming & entertainment, fintech & banking, e-commerce & retail, and more — with dedicated practices for data annotation, trust & safety, social media, talent and process automation.'],
            ['How fast can we launch?', 'Most programs launch within 2–4 weeks. We offer phased rollouts and surge capacity for peaks so you can scale without friction.'],
            ['Is my data secure?', 'Yes. We apply enterprise-grade security controls, strict data handling policies and compliance-ready processes across every engagement.'],
            ['How do I schedule a consultation?', 'Simply tap the Schedule Consultation button anywhere on the site to chat with us directly on WhatsApp, or email us at hi@startoutai.com.'],
        ];

        $stmt = $pdo->prepare(
            'INSERT INTO faqs (question, answer, is_active, sort_order)
             VALUES (:question, :answer, 1, :sort_order)'
        );

        foreach ($rows as $i => $row) {
            $stmt->execute([
                'question' => $row[0],
                'answer' => $row[1],
                'sort_order' => $i + 1,
            ]);
        }
    }
}
