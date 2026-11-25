# WedaLink Admin Panel (PHP)

This is the web-based administrative control center for **WedaLink**, built in clean, modular PHP matching the system UI design specification.

## Directory Structure

```text
admin/
├── index.php                     # Main Dashboard (Overview & Operations Stats)
├── api/
│   └── actions.php               # AJAX endpoint for approvals, rejections & moderation
├── assets/
│   ├── css/
│   │   └── admin.css             # UI styling based on WadaLink design system
│   └── js/
│       └── admin.js              # Interactive filters, live search, AJAX actions & toasts
├── includes/
│   ├── config.php                # State store, timezone (SLST UTC+5:30), demo data
│   ├── header.php                # HTML head, fonts, shared styles
│   ├── sidebar.php               # Core navigation & system admin identity
│   ├── topbar.php                # Search bar, operational status pill, admin actions
│   └── footer.php                # Modal, toasts, script imports
└── pages/
    ├── provider-approvals.php    # Dedicated credential verification queue
    ├── service-listings.php      # Customer request & moderation queue
    ├── equipment-rentals.php     # Equipment rental management
    ├── reviews-reports.php       # Dispute arbitration & reviews
    └── activity-logs.php         # Immutable admin audit ledger
```

## Running the Admin Panel

### Option 1: Using PHP Built-in Server (Quickest)

From the project root:
```powershell
php -S localhost:8080 -t admin
```
Or if using XAMPP's PHP:
```powershell
C:\xampp\php\php.exe -S localhost:8080 -t D:\WadaLink\admin
```

Then open your browser at:
`http://localhost:8080`

### Option 2: Using Apache / XAMPP

1. Place or alias this `admin` directory inside `C:\xampp\htdocs\wedalink-admin`.
2. Start Apache from the XAMPP Control Panel.
3. Access `http://localhost/wedalink-admin`.

## Features Implemented from UI Design

- **National Dispatch Stream Bar**: Island-wide real-time operational status (SLST UTC +5:30) with auto-sync indicator.
- **Top 4 Operations Metric Cards**:
  - `Pending Provider Approvals` (Action Needed)
  - `Active Service Jobs` (Active)
  - `Active Equipment Rentals` (In Circulation)
  - `Flagged Reviews & Chats` (Review Required)
- **Pending Provider Applications**:
  - Filter pills (`All`, `Electrician`, `Plumber`, `AC Tech`).
  - Technician profile cards with trade, location, phone, NVQ experience, and NIC document status.
  - Interactive `Approve Provider` and `Reject` buttons with real-time UI card removal and log updates.
- **Recent Listings Awaiting Moderation**:
  - Requests & equipment items with smart match ratings.
  - One-click `Approve` or `Remove Listing`.
- **Recent Admin Logs Feed**:
  - Live activity ledger recording all actions taken by administrators.
- **Sri Lanka Provincial Dispatch**:
  - Breakdown across Western, Central, and North Western provinces.
- **Daily Audit PDF**:
  - Interactive report preview and print/export feature.
