# HvacLeadPilot — AI Inbound Inquiry Triage CRM for HVAC Contractors (Laravel Filament)

**HvacLeadPilot** is a modular Laravel + Filament SaaS that helps HVAC contractors classify website, phone, and email inquiries into qualified CRM opportunities, then operate on service requests, field technicians, and job tickets — with AI assist, human approval, and full audit logging.

## SEO / Niche Keywords

HVAC contractor CRM, inbound inquiry triage, AI lead classification, HVAC sales operations, service request management, field technician dispatch, job tickets HVAC, AC emergency repair triage, furnace no-heat intake, heat pump install quotes, ductwork and refrigerant leads, IAQ humidifier inquiry routing, thermostat install leads, Jobber alternative intake, ServiceTitan lead routing, QuickBooks customer handoff, Google Calendar dispatch, TCPA messaging consent, licensed HVAC technician operations software, home & field services automation, Laravel Filament SaaS, modular AI business automation, USA HVAC contractors 2026

### Related keyword tags
`hvac-contractors` `inbound-inquiry-triage` `ai-lead-scoring` `crm-opportunities` `service-requests` `field-technicians` `job-tickets` `sales-operations` `home-field-services` `laravel` `filament` `docker` `saas` `ai-automation` `human-approval-workflow` `audit-log` `messaging-consent` `ac-repair` `heat-pump` `furnace` `ductwork` `jobber` `servicetitan` `quickbooks` `google-calendar`

## Problem solved

For HVAC contractors: classify website, phone and email inquiries and create qualified CRM opportunities; operate on service requests, field technicians and job tickets.

- **Target buyer:** HVAC Contractors owner / operations lead  
- **Workflow:** Inbound Inquiry Triage  
- **Function:** Sales operations  
- **MVP:** 1 intake trigger → draft/action → human approval → audit log  
- **Pricing hypothesis:** Pilot $199–$799/mo  
- **Risk/compliance:** MED — messaging consent, licensing and safety  

## Features & modules

All modules are toggleable in Filament → **Feature Modules** (or `config/modules.php` defaults).

### Core (ON by default)
- Inbound Inquiry Triage  
- AI Classification (`hvac-triage-v1`: no-cool emergency, furnace, heat pump, AC install, maintenance, ductwork, refrigerant, IAQ, thermostat)  
- Human Approval Workflow  
- CRM Opportunities  
- Service Requests  
- Field Technicians  
- Job Tickets  
- Audit Log  
- Messaging Consent  
- Follow-Up Drafts  
- Universal Slug Engine  
- AI Hub Provider Switch (local equivalent)  
- Drutogoti Speed Layer (local equivalent)  
- Admin Panel Extras (local equivalent)  

### Optional / niche (OFF by default)
- Customer Portal  
- Attendance Hub (local `laravel-attendance-hub` equivalent)  
- Unicode PDF Exports (local `laravel-unicode-pdf` equivalent)  
- AI Catalog / Lead Scrape (local `laravel-ai-catalog` equivalent)  
- Jobber / ServiceTitan / QuickBooks / Google Calendar integrations  
- Multi-Location  

> Packagist packages under `imrandevbd/*` were not installable at build time (stability/availability). Equivalent local services ship in `app/Services/` and are documented here.

## Multi-type demo users

Password for all: **`password`**

| Role | Email |
|------|-------|
| Admin | admin@hvacleadpilot.test |
| Owner | owner@hvacleadpilot.test |
| Staff | staff@hvacleadpilot.test |
| Technician | tech@hvacleadpilot.test |
| Customer (no Filament) | customer@hvacleadpilot.test |

Admin panel: [http://localhost:8110/admin](http://localhost:8110/admin)

## Public marketing pages

- `/` Home — brand + product story  
- `/features` All capabilities  
- `/modules` Every module ON/OFF  
- `/workflow` MVP triage flow  
- `/pricing` Pilot pricing  
- `/demo` Live intake form + credentials  
- `/contact` Hire / contact  

## Docker run

```bash
docker compose up -d --build
```

App URL: **http://localhost:8110**

Services:
- `app` → host **8110**
- `mysql` → host **33070**
- `redis` → host **63800**

First boot runs migrations, seeds demo data, and publishes Filament assets.

Stop:

```bash
docker compose down
```

## Local (non-Docker) quickstart

```bash
cp .env.example .env
# set DB_CONNECTION=sqlite and touch database/database.sqlite if preferred
php C:\Users\USER\Documents\usa_business\pipeline\apps\composer.phar install
php artisan key:generate
php artisan migrate --seed
php artisan serve --port=8110
```

## Tech stack

- PHP 8.3+ / Laravel 13  
- Filament 4 admin  
- MySQL 8.4 + Redis 7 (Docker)  
- Modular feature flags (`ModuleSetting` + `ModuleManager`)  
- Heuristic AI triage engine (`AiTriageService`) with approval workflow  
- Docker Compose  

## Screenshots

See `docs/screenshots/`:

- `home.png` — marketing home  
- `features.png` — features page  
- `admin-dashboard.png` — Filament triage stats  
- `inquiries.png` — inquiry triage module  

## Repository docs

- Build prompt archive: [`docs/BUILD_PROMPT.md`](docs/BUILD_PROMPT.md)

## Contact / Hire

- Developer: Imran Ahmed (IMRAN Dev BD)
- Website: https://imrandev.bd/contact
- Email: me@imrandev.bd
- GitHub: https://github.com/imranbru99
