<?php
/**
 * WedaLink Control Center - Activity Logs
 */
declare(strict_types=1);

require_once __DIR__ . '/../includes/config.php';

$currentPage = 'logs';
$pendingCount = getPendingProvidersCount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Activity Logs &bull; <?= htmlspecialchars(APP_NAME) ?></title>
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
      <a href="../index.php" class="nav-link">
        <div class="nav-link-content">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect>
          </svg>
          <span>Overview &amp; Stats</span>
        </div>
      </a>
      <a href="provider-approvals.php" class="nav-link">
        <div class="nav-link-content">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path><path d="m9 12 2 2 4-4"></path>
          </svg>
          <span>Provider Approvals</span>
        </div>
        <span class="nav-badge danger"><?= $pendingCount ?></span>
      </a>
      <a href="service-listings.php" class="nav-link">
        <div class="nav-link-content">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
          </svg>
          <span>Service Listings</span>
        </div>
      </a>
      <a href="equipment-rentals.php" class="nav-link">
        <div class="nav-link-content">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
          </svg>
          <span>Equipment Rentals</span>
        </div>
      </a>
      <a href="reviews-reports.php" class="nav-link">
        <div class="nav-link-content">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line>
          </svg>
          <span>Reviews &amp; Reports</span>
        </div>
      </a>
      <a href="activity-logs.php" class="nav-link active">
        <div class="nav-link-content">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline>
          </svg>
          <span>Activity Logs</span>
        </div>
      </a>
    </nav>
  </aside>

  <div class="main-wrapper">
    <header class="topbar">
      <div class="search-container">
        <div class="search-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
        </div>
        <input type="text" class="search-input" placeholder="Search system audit records...">
      </div>
      <div class="topbar-actions">
        <a href="../index.php" class="btn-admin-actions" style="text-decoration:none;">&larr; Back to Dashboard</a>
      </div>
    </header>

    <main class="page-content">
      <div class="page-header-row">
        <div class="header-title-group">
          <h1>System Activity &amp; Audit Ledger</h1>
          <p>Chronological immutable records of administrative approvals, moderation decisions, and user dispute arbitrations.</p>
        </div>
      </div>

      <section class="content-box">
        <div class="content-box-header">
          <h2 class="box-title">Audit Trail (SLST UTC +5:30)</h2>
          <span class="live-badge">Live Sync</span>
        </div>

        <div class="admin-logs-timeline" id="admin-logs-timeline" style="margin-top: 10px;">
          <?php foreach ($_SESSION['wedalink_logs'] as $log): ?>
            <div class="log-timeline-entry">
              <div class="log-dot-circle"></div>
              <div class="log-content-body">
                <div class="log-header-line">
                  <span class="log-action-text"><?= htmlspecialchars($log['action']) ?></span>
                  <span class="log-timestamp"><?= htmlspecialchars($log['time']) ?></span>
                </div>
                <div class="log-subtext"><?= htmlspecialchars($log['detail']) ?></div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </section>
    </main>
  </div>
</div>

<script src="../assets/js/admin.js"></script>
</body>
</html>
