<?php
/**
 * WedaLink Control Center - Equipment Rentals & Reviews
 */
declare(strict_types=1);

require_once __DIR__ . '/../includes/config.php';

$currentPage = 'equipment';
$pendingCount = getPendingProvidersCount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Equipment Rentals &bull; <?= htmlspecialchars(APP_NAME) ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<div class="admin-shell">
  <aside class="sidebar">
    <div class="brand-section">
      <div class="brand-logo-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
        </svg>
      </div>
      <div class="brand-details">
        <span class="brand-title"><?= htmlspecialchars(APP_NAME) ?></span>
        <span class="brand-subtitle"><?= htmlspecialchars(APP_TAGLINE) ?></span>
      </div>
    </div>
    <div class="nav-eyebrow">CORE NAVIGATION</div>
    <nav class="sidebar-nav">
      <a href="../index.php" class="nav-link"><div class="nav-link-content"><span>Overview &amp; Stats</span></div></a>
      <a href="provider-approvals.php" class="nav-link"><div class="nav-link-content"><span>Provider Approvals</span></div><span class="nav-badge danger"><?= $pendingCount ?></span></a>
      <a href="service-listings.php" class="nav-link"><div class="nav-link-content"><span>Service Listings</span></div></a>
      <a href="equipment-rentals.php" class="nav-link active"><div class="nav-link-content"><span>Equipment Rentals</span></div></a>
      <a href="reviews-reports.php" class="nav-link"><div class="nav-link-content"><span>Reviews &amp; Reports</span></div></a>
      <a href="activity-logs.php" class="nav-link"><div class="nav-link-content"><span>Activity Logs</span></div></a>
    </nav>
  </aside>
  <div class="main-wrapper">
    <header class="topbar">
      <a href="../index.php" class="btn-admin-actions" style="text-decoration:none;">&larr; Back to Dashboard</a>
    </header>
    <main class="page-content">
      <div class="page-header-row">
        <div class="header-title-group">
          <h1>Equipment Rentals Management</h1>
          <p>Monitor rented industrial tools, rotary hammer drills, and generator availability across active hubs.</p>
        </div>
      </div>
      <section class="content-box">
        <h2 class="box-title">Active Equipment in Circulation (14 Units)</h2>
        <p style="margin-top: 10px; color: var(--secondary-text);">All rental units currently checked out across Colombo, Maharagama, and Kandy hubs are verified and insured.</p>
      </section>
    </main>
  </div>
</div>
</body>
</html>
