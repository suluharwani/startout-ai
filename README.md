# Motrive — Company Profile (PHP)

A modern, fully dynamic company profile for **Motrive** built with **PHP 8** (no framework, custom router),
**MySQL / MariaDB**, **Bootstrap 5** and a clean custom design system with light/dark themes.

Everything on the site is content-managed through an **admin panel** (company profile, services,
testimonials, team, jobs, FAQs, static pages, contact inbox).

---

## ✨ Features

- **Custom front-controller routing** — clean URLs like `/services/trust-safety` (works in sub-folders too)
- **100% dynamic content** stored in MySQL, seeded with rich demo content on first run
- **Secure by default**
  - PDO **prepared statements** everywhere → safe from SQL injection
  - **CSRF protection** on every POST (login, forms, admin CRUD)
  - Passwords hashed with `password_hash()` / `password_verify()`
  - Honeypot + rate-limit on the contact form / login
  - Uploads validated by type & size
- **Layouts & partials** — header/footer/hero rendered once and reused on every page (easy maintenance)
- **Admin panel** at `/admin` (modern redesigned UI) to manage the whole website:
  - **Company profile** — name, tagline, email, phone, WhatsApp, address, social links, hero, footer
  - **Logo & favicon upload** with preview (used in header, footer, admin, browser tab & OG image)
  - Services / Testimonials / Team / Jobs / FAQs CRUD
  - Static pages (About, Resources) editor
  - Contact inbox with unread badge + reply shortcuts
  - Change admin password
- **First-run registration** — when no admin exists yet, `/admin` shows a **register** screen to create the first account (no default credentials)
- **SEO-ready**
  - Dynamic `sitemap.xml` (all pages + services) and `robots.txt`
  - Canonical URLs, Open Graph + Twitter cards, `og:image` from your logo
  - JSON-LD `Organization` structured data
  - Custom favicon + meta description from settings
- **Persistent dark/light mode** (remembers your choice across pages via `localStorage`)
- **WhatsApp-first** "Schedule Consultation" buttons everywhere (`wa.me/628602268666`)
- Scroll-reveal animations, responsive mobile menu

---

## 🗄️ Requirements

- PHP **8.1+** with `pdo_mysql`, `openssl`, `session`, `mbstring`
- MySQL **5.7+** / MariaDB (tested with MariaDB 10/12)

---

## 🚀 Installation

### Option A — Auto-install (recommended)

1. Copy the project into your web root (e.g. XAMPP `htdocs/motrive`).
2. Make sure MySQL is running on `127.0.0.1:3306`.
3. Open `http://localhost/motrive/` in your browser.
   - The app **creates the database + tables + seed content automatically** on the first request
     (credentials come from `.env`).
4. Done.

### Option B — Manual install

1. Create the database and tables:
   - Open **phpMyAdmin** → Import `database/schema.sql`, **or**
   - Run `mysql -u root -p12345 < database/schema.sql`
2. Point the app at your database (see **Configuration** below).
3. Open the site — the app seeds the demo content automatically if the tables are empty.

### Configuration (`.env`)

Copy `.env.example` to `.env` and adjust (the file is already present with defaults):

```ini
APP_ENV=local
APP_NAME="Motrive"
APP_TIMEZONE=Asia/Jakarta

SESSION_NAME=motrive_session
APP_KEY=CHANGE_ME_TO_A_RANDOM_STRING

# MySQL — matches the requirement: localhost / root / 12345 / 3306
DB_HOST=127.0.0.1
DB_PORT=3306
DB_NAME=motrive
DB_USER=root
DB_PASS=12345
```

> ⚠️ On a **public server** set `APP_ENV=production`, change `APP_KEY`, change the admin password
> and use strong DB credentials.

---

## 🧪 Running locally

### With XAMPP / WAMP (Apache)

Put the folder in `htdocs` and visit `http://localhost/<folder>/`. The included `.htaccess`
routes everything through `index.php`.

### With the PHP built-in server

```bash
cd "path/to/project"
php -S localhost:8000 dev-server.php
```

Then open `http://localhost:8000/`.

---

## 🔐 Admin Panel

| URL       | `/admin`         |
|-----------|------------------|
| Login     | `/admin/login`   |
| Register  | `/admin/register` |

**First-run registration:** there is **no default password**. On a fresh install the
`users` table is empty, so `/admin` shows a **"Create admin account"** screen — the very
first visitor registers the super-admin. After that, the registration screen is disabled
and everyone signs in at `/admin/login`.

> The original auto-seeded `admin@motrive.com / admin123` account has been removed for
> security. If you upgraded from an earlier version, your existing account still works.

---

## 🧭 Pages

| Route                    | Page                          |
|--------------------------|-------------------------------|
| `/`                      | Home                          |
| `/about`                 | About Us                      |
| `/services`              | Services overview             |
| `/services/{slug}`       | Service detail (8 services)   |
| `/start-journey`         | Start Your Journey            |
| `/resources`             | Resources (guides & insights) |
| `/careers`               | Careers (ATS feed + apply)    |
| `/contact`               | Contact (CSRF form → inbox)   |
| `/sitemap.xml`           | XML sitemap (SEO)             |
| `/robots.txt`            | robots directives (SEO)       |
| `/admin`                 | Admin dashboard               |

Service slugs: `data-annotation`, `trust-safety`, `talent-solution`, `social-media`,
`gaming-entertainment`, `fintech-banking`, `ecommerce-retail`, `process-automation`.

> **Content Moderation** has been folded into **Trust & Safety** (no separate page), per the revision list.

---

## 📁 Project structure

```
├── .env / .env.example      # configuration
├── .htaccess                # Apache URL rewriting (front controller)
├── index.php                # front controller + route definitions
├── dev-server.php           # router for `php -S`
├── config/
│   ├── bootstrap.php        # autoload, session, CSRF, DB boot
│   ├── config.php           # loads .env, constants
│   └── helpers.php          # e(), url(), csrf_*, setting(), wa_link(), render()...
├── app/
│   ├── Core/                # Database (PDO), Router, Installer (schema + seed)
│   ├── Controllers/         # Page, Contact, Auth, Admin
│   ├── Models/              # PDO models (prepared statements)
│   └── Views/
│       ├── layouts/         # main, header, footer, admin, admin-guest
│       ├── home.php ...     # public pages
│       ├── auth/login.php
│       └── admin/           # dashboard, settings, CRUD forms, inbox
├── database/schema.sql      # manual import reference
└── assets/
    ├── css/style.css        # public design system (light/dark)
    ├── css/admin.css        # admin design
    ├── js/script.js         # theme toggle, menu, FAQ, reveal
    └── uploads/             # uploaded images
```

---

## 🛠️ Maintenance tips

- **All content** (headings, services, contact details, WhatsApp number, social links, footer) is editable
  in **Admin → Company Profile** — no code changes needed.
- Uploaded images go to `assets/uploads/` (keep that folder writable).
- The schema is created idempotently on every boot — safe to re-deploy.
- To reset the site content, drop the database and reload the page (it re-seeds).

---

## ✅ Motrive rebrand checklist applied

1. Home **Start Your Journey** button links to `/contact`; **Customer Experience AI** button removed
2. **Start Journey**: WhatsApp schedule + number `628602268666`, email `hi@motrive.com`,
   no empty placeholder boxes
3. **Data Annotation** page: *Start Your Journey* & *Schedule Consultation* both linked
4. **Trust & Safety**: *Schedule Consultation* button present
5. **Content Moderation** removed as a separate page — folded into Trust & Safety (footer included)
6. **Talent Solution / Social Media / Gaming & Entertainment / Fintech & Banking / E-commerce & Retail /
   Process Automation**: *Schedule Consultation* all linked; "AI" removed from industry page titles
7. **Careers**: openings come from an optional external ATS feed (see "Careers & ATS feed") or the
   admin-managed jobs list, with LinkedIn as the fallback apply destination
8. **Resources**: no subscription form / button
9. **Footer**: Twitter icon → **X**, LinkedIn → company page, email icon → `hi@motrive.com`
10. **Dark/Light mode** persists across pages (`localStorage`)

---

## 🧲 Careers & ATS feed

LinkedIn does not offer a public API for listing a company's job postings, so real-time sync has to come
from your recruiting system instead. Most ATS platforms (Greenhouse, Lever, Workable, Recruitee, Ashby…)
provide a public JSON feed of open jobs — the same feed that typically auto-posts to your LinkedIn page.

1. In **Admin → Company Profile → Jobs & ATS feed**, paste your public jobs feed URL
   (e.g. `https://boards-api.greenhouse.io/v1/boards/{company}/jobs`).
2. The **Careers** page fetches that feed (cached for 5 minutes) and lists the openings with their apply
   links automatically. If the feed is unavailable or not configured, it falls back to the jobs managed
   in the admin panel.
3. Supported formats: Greenhouse, Lever, and generic JSON arrays (`{ "data": [...] }`, `{ "results": [...] }`).

