<?php
/**
 * WedaLink Control Center - Service Listings Moderation
 * PHP Admin Implementation matching UI Design Specifications
 */
declare(strict_types=1);

require_once __DIR__ . '/../includes/config.php';

$currentPage = 'listings';
$pendingCount = getPendingProvidersCount();
$serviceRequests = $_SESSION['wedalink_service_requests'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Service Listings Moderation &bull; <?= htmlspecialchars(APP_NAME) ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<div class="admin-shell">
  <!-- Sidebar Navigation -->
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
        <span class="nav-badge danger" id="nav-pending-badge"><?= $pendingCount ?></span>
      </a>
      <a href="service-listings.php" class="nav-link active">
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
      <a href="activity-logs.php" class="nav-link">
        <div class="nav-link-content">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline>
          </svg>
          <span>Activity Logs</span>
        </div>
      </a>
    </nav>

    <div class="sidebar-footer">
      <div class="user-profile-widget">
        <div class="user-profile-left">
          <div class="user-avatar-circle"><?= htmlspecialchars(ADMIN_INITIALS) ?></div>
          <div class="user-info">
            <span class="user-name"><?= htmlspecialchars(ADMIN_NAME) ?></span>
            <span class="user-role"><?= htmlspecialchars(ADMIN_ROLE) ?></span>
          </div>
        </div>
        <button class="logout-btn" title="Sign out" onclick="if(confirm('Sign out from WedaLink Control Center?')) showToast('Session locked.', 'error');">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line>
          </svg>
        </button>
      </div>
    </div>
  </aside>

  <!-- Main Content Area -->
  <div class="main-wrapper">
    <header class="topbar">
      <div class="search-container">
        <div class="search-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
        </div>
        <input type="text" class="search-input" placeholder="Search providers, requests, equipment in Sri Lanka...">
      </div>

      <div class="topbar-actions">
        <div class="status-pill">
          <span class="status-dot"></span>
          <span>System Operational &bull; Sri Lanka</span>
        </div>
        <button class="icon-btn-round" title="View Notifications" onclick="showToast('NLP classification queues operating normally.', 'success');">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
          </svg>
          <span class="badge-dot"></span>
        </button>
        <button class="btn-admin-actions" onclick="showToast('Admin actions toolbar active.', 'success');">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
          </svg>
          <span>Admin Actions</span>
        </button>
        <button class="user-profile-button" title="Admin Profile">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 18px; height: 18px;">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle>
          </svg>
        </button>
      </div>
    </header>

    <main class="page-content">
      <!-- Header Row with Meta Stream, Title, and Right Stats Cluster -->
      <div class="page-header-row">
        <div class="header-title-group">
          <div class="header-meta-stream">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width: 14px; height: 14px; color: #0F766E;">
              <circle cx="12" cy="12" r="10"></circle>
              <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
            <span>AUTOMATED DISPATCH ENGINE &bull; WEDALINK SRI LANKA</span>
          </div>
          <h1>Service Listings Moderation</h1>
          <p>Audit customer job requests, inspect AI classification accuracy, and manage platform listings across Western, Central, and Southern provinces.</p>
        </div>

        <div class="header-stats-cluster">
          <div class="header-stat-item">
            <span class="header-stat-label">QUEUED JOBS</span>
            <span class="header-stat-value">36</span>
          </div>
          <div class="header-stat-item">
            <span class="header-stat-label danger">FLAGGED</span>
            <span class="header-stat-value danger">3</span>
          </div>
        </div>
      </div>

      <!-- Top Section: Filter Tabs & AI Telemetry Row -->
      <section class="service-top-grid">
        <!-- Left Filter Card -->
        <div class="filter-card-shell">
          <div>
            <div class="service-tabs-row">
              <button class="service-tab-pill active" data-tab="all">
                <span>All Requests</span>
                <span class="service-tab-badge">36</span>
              </button>
              <button class="service-tab-pill" data-tab="ai">
                <span>AI-Categorized</span>
                <span class="service-tab-badge" style="background:#E2E8F0; color:#334155;">28</span>
              </button>
              <button class="service-tab-pill" data-tab="flagged">
                <span>Flagged / Reported</span>
                <span class="service-tab-badge danger">3</span>
              </button>
              <button class="service-tab-pill" data-tab="review">
                <span>Under Review</span>
                <span class="service-tab-badge" style="background:#F1F5F9; color:#475569;">5</span>
              </button>
            </div>
            <div class="nlp-parser-subtext">
              <span class="nlp-dot"></span>
              <span>Real-time Sri Lanka NLP parser active</span>
            </div>
          </div>

          <div class="filter-inputs-row">
            <div class="table-search-box" style="width: 100%;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
              </svg>
              <input 
                type="text" 
                id="service-search-input" 
                placeholder="Search request title, customer name, location..."
              >
            </div>

            <select class="table-select" id="service-cat-select">
              <option value="all">All Categories</option>
              <option value="Plumbing">Plumbing</option>
              <option value="AC Repair">AC Repair</option>
              <option value="Electrical">Electrical</option>
              <option value="Carpentry">Carpentry</option>
              <option value="Masonry">Masonry</option>
            </select>

            <select class="table-select" id="service-status-select">
              <option value="all">All Statuses</option>
              <option value="Open">Open</option>
              <option value="In Progress">In Progress</option>
              <option value="Completed">Completed</option>
              <option value="Flagged">Flagged</option>
            </select>
          </div>
        </div>

        <!-- Right AI Telemetry Card -->
        <div class="ai-telemetry-card">
          <div>
            <div class="telemetry-header">
              <div class="telemetry-title-area">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 2v20M2 12h20M4.93 4.93l14.14 14.14M4.93 19.07l14.14-14.14"></path>
                </svg>
                <span>AI Classification Telemetry</span>
              </div>
              <button class="btn-filter-icon" style="width: 30px; height: 30px;" title="Telemetry Settings">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 14px; height: 14px;">
                  <line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line>
                  <line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line>
                  <line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line>
                  <line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line>
                </svg>
              </button>
            </div>

            <div class="telemetry-body-row">
              <div class="telemetry-ring-wrap">
                <svg viewBox="0 0 36 36">
                  <path class="telemetry-ring-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                  <path class="telemetry-ring-fill" stroke-dasharray="96.4, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                </svg>
                <div class="telemetry-pct-text">96.4%</div>
              </div>

              <div class="telemetry-copy">
                <span class="benchmark-badge-title">High Precision Benchmark</span>
                <span class="benchmark-desc">142 requests processed this month in Sri Lanka.</span>
                <span class="benchmark-sub">False match: 1.2% (down 0.8%)</span>
              </div>
            </div>
          </div>

          <div class="telemetry-footer-stats">
            <span class="telemetry-footer-item">Auto-Dispatched: <strong>118</strong></span>
            <span class="telemetry-footer-item">Manual Override: <strong>6</strong></span>
          </div>
        </div>
      </section>

      <!-- Main Moderation Queue White Container -->
      <section class="table-card-container">
        <!-- Table Card Header -->
        <div class="table-toolbar-row">
          <div style="display: flex; align-items: center; gap: 10px;">
            <h2 class="box-title" style="font-size: 15.5px;">Service Job Moderation Queue</h2>
            <span class="service-tab-badge" style="background:#EBF3FF; color:var(--primary-blue); font-weight:700;">5 Active in View</span>
          </div>

          <div>
            <button class="btn-primary-action" onclick="showToast('Service moderation queue exported.', 'success');" style="padding: 7px 14px; font-size: 12px;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 14px; height: 14px;">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                <polyline points="7 10 12 15 17 10"></polyline>
                <line x1="12" y1="15" x2="12" y2="3"></line>
              </svg>
              <span>Export Queue</span>
            </button>
          </div>
        </div>

        <!-- Moderation Data Table -->
        <div class="table-responsive">
          <table class="approvals-data-table">
            <thead>
              <tr>
                <th>REQUEST ID</th>
                <th>CUSTOMER</th>
                <th>JOB REQUEST</th>
                <th>AI CLASSIFICATION &amp; CONFIDENCE</th>
                <th>LOCATION</th>
                <th>URGENCY</th>
                <th>STATUS</th>
                <th style="text-align: right;">MODERATION ACTIONS</th>
              </tr>
            </thead>
            <tbody id="service-requests-table-body">
              <?php foreach ($serviceRequests as $req): ?>
                <tr 
                  id="service-row-<?= htmlspecialchars($req['id']) ?>"
                  class="<?= $req['is_flagged'] ? 'tr-flagged' : '' ?>"
                  data-cat="<?= htmlspecialchars($req['category']) ?>"
                  data-status="<?= htmlspecialchars($req['status']) ?>"
                  data-flagged="<?= $req['is_flagged'] ? '1' : '0' ?>"
                >
                  <!-- Request ID -->
                  <td>
                    <div class="req-id-col">
                      <?php if ($req['is_flagged']): ?>
                        <svg class="req-flag-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path>
                          <line x1="4" y1="22" x2="4" y2="15"></line>
                        </svg>
                      <?php else: ?>
                        <span class="req-radio-circle"></span>
                      <?php endif; ?>
                      <div class="req-id-text-group">
                        <span class="req-id-code" style="<?= $req['is_flagged'] ? 'color:#DC2626;' : '' ?>">#<?= htmlspecialchars($req['id']) ?></span>
                        <span class="req-time-ago"><?= htmlspecialchars($req['time_ago']) ?></span>
                      </div>
                    </div>
                  </td>

                  <!-- Customer -->
                  <td>
                    <div class="table-provider-col">
                      <div class="avatar-initials-badge <?= htmlspecialchars($req['customer_color']) ?>" style="<?= $req['is_flagged'] ? 'background:#FEE2E2; color:#DC2626; font-weight:800;' : '' ?>">
                        <?= htmlspecialchars($req['customer_initials']) ?>
                      </div>
                      <div class="table-provider-info">
                        <span class="table-provider-name" style="<?= $req['is_flagged'] ? 'color:#DC2626;' : '' ?>"><?= htmlspecialchars($req['customer_name']) ?></span>
                        <span class="table-provider-nic">
                          <?php if (str_contains($req['customer_sub'], 'Verified')): ?>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 12px; height: 12px; color: var(--primary-blue); vertical-align: middle;">
                              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            </svg>
                          <?php endif; ?>
                          <?= htmlspecialchars($req['customer_sub']) ?>
                        </span>
                      </div>
                    </div>
                  </td>

                  <!-- Job Request -->
                  <td>
                    <div class="job-title-line"><?= htmlspecialchars($req['title']) ?></div>
                    <div class="job-badges-wrap">
                      <?php foreach ($req['badges'] as $b): ?>
                        <span class="sub-tag-pill <?= htmlspecialchars($b['type']) ?>">
                          <?php if ($b['type'] === 'media'): ?>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 12px; height: 12px;">
                              <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                              <circle cx="8.5" cy="8.5" r="1.5"></circle>
                              <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                          <?php elseif ($b['type'] === 'voice'): ?>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 12px; height: 12px;">
                              <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"></path>
                              <path d="M19 10v2a7 7 0 0 1-14 0v-2"></path>
                              <line x1="12" y1="19" x2="12" y2="23"></line>
                              <line x1="8" y1="23" x2="16" y2="23"></line>
                            </svg>
                          <?php elseif ($b['type'] === 'danger' || $b['type'] === 'security_alert'): ?>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 12px; height: 12px; color:#DC2626;">
                              <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                              <line x1="12" y1="8" x2="12" y2="12"></line>
                              <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                          <?php else: ?>
                            &bull;
                          <?php endif; ?>
                          <?= htmlspecialchars($b['text']) ?>
                        </span>
                      <?php endforeach; ?>
                    </div>
                  </td>

                  <!-- AI Classification & Confidence -->
                  <td>
                    <div class="ai-classification-cell">
                      <?php
                        $catLower = strtolower($req['category']);
                        $catClass = 'plumbing';
                        if (str_contains($catLower, 'ac')) $catClass = 'ac';
                        elseif (str_contains($catLower, 'elec')) $catClass = 'electrical';
                        elseif (str_contains($catLower, 'carp')) $catClass = 'carpentry';
                        elseif (str_contains($catLower, 'mas')) $catClass = 'masonry';
                      ?>
                      <span class="ai-category-badge <?= $catClass ?>">
                        <?php if ($catClass === 'plumbing'): ?>
                          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 12px; height: 12px;">
                            <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path>
                          </svg>
                        <?php elseif ($catClass === 'ac'): ?>
                          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 12px; height: 12px;">
                            <path d="M12 2v20M2 12h20"></path>
                          </svg>
                        <?php elseif ($catClass === 'electrical'): ?>
                          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 12px; height: 12px;">
                            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                          </svg>
                        <?php else: ?>
                          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 12px; height: 12px;">
                            <circle cx="12" cy="12" r="10"></circle>
                          </svg>
                        <?php endif; ?>
                        <?= htmlspecialchars($req['category']) ?>
                      </span>

                      <span class="ai-confidence-sub <?= $req['is_flagged'] ? 'low' : '' ?>">
                        <?= htmlspecialchars($req['confidence']) ?> Confidence &bull; <?= htmlspecialchars($req['confidence_status']) ?>
                      </span>
                    </div>
                  </td>

                  <!-- Location -->
                  <td>
                    <div class="table-city-col">
                      <span class="table-city-title" style="display: flex; align-items: center; gap: 4px;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 13px; height: 13px; color: var(--muted-text);">
                          <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                          <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <?= htmlspecialchars($req['city']) ?>
                      </span>
                      <span class="table-province-sub"><?= htmlspecialchars($req['district']) ?></span>
                    </div>
                  </td>

                  <!-- Urgency -->
                  <td>
                    <?php if ($req['urgency'] === 'High'): ?>
                      <span class="urgency-indicator high">
                        <span class="urgency-dot"></span>
                        High
                      </span>
                    <?php elseif ($req['urgency'] === 'Normal'): ?>
                      <span class="urgency-indicator normal">Normal</span>
                    <?php else: ?>
                      <span class="urgency-indicator low">Low</span>
                    <?php endif; ?>
                  </td>

                  <!-- Status -->
                  <td>
                    <?php if ($req['status'] === 'Open'): ?>
                      <span style="font-weight: 600; color: var(--primary-text);">Open</span>
                    <?php elseif ($req['status'] === 'In Progress'): ?>
                      <span style="font-weight: 600; color: #0284C7;">In Progress</span>
                    <?php elseif ($req['status'] === 'Completed'): ?>
                      <span style="font-weight: 600; color: #16A34A;">Completed</span>
                    <?php else: ?>
                      <span class="service-tab-badge danger" style="padding: 3px 8px; font-size: 11px;">Flagged</span>
                    <?php endif; ?>
                  </td>

                  <!-- Moderation Actions -->
                  <td>
                    <div class="table-actions-group">
                      <?php if ($req['is_flagged']): ?>
                        <!-- Flagged Row Actions -->
                        <button 
                          type="button" 
                          class="btn-action-inspect" 
                          title="Inspect AI classification audit"
                          onclick="inspectRequestModal('<?= htmlspecialchars($req['id']) ?>', '<?= addslashes($req['title']) ?>', '<?= addslashes($req['customer_name']) ?>', '<?= addslashes($req['category']) ?>', '<?= addslashes($req['confidence']) ?>', 'High')"
                        >
                          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 14px; height: 14px;">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                          </svg>
                          <span>Inspect</span>
                        </button>
                        <button 
                          type="button" 
                          class="btn-action-remove-solid" 
                          onclick="deleteRequestRow('<?= htmlspecialchars($req['id']) ?>')"
                        >
                          <span>Remove &times;</span>
                        </button>
                      <?php else: ?>
                        <!-- Standard Row Actions -->
                        <?php if ($req['status'] === 'Completed'): ?>
                          <button type="button" class="btn-tbl-approve" style="background:#F1F5F9; color:#475569; border-color:#E2E8F0;" disabled>
                            <span>&check;</span> Approved
                          </button>
                        <?php else: ?>
                          <button 
                            type="button" 
                            class="btn-tbl-approve" 
                            onclick="showToast('Listing #<?= htmlspecialchars($req['id']) ?> dispatch approved.', 'success'); this.disabled=true; this.style.opacity='0.6';"
                          >
                            <span>&check;</span> Approve
                          </button>
                        <?php endif; ?>

                        <button 
                          type="button" 
                          class="btn-action-reassign" 
                          title="Reassign Category"
                          onclick="reassignRequest('<?= htmlspecialchars($req['id']) ?>', '<?= addslashes($req['category']) ?>')"
                        >
                          <span>&#8644;</span> Reassign
                        </button>

                        <button 
                          type="button" 
                          class="btn-action-delete" 
                          title="Delete Request" 
                          onclick="deleteRequestRow('<?= htmlspecialchars($req['id']) ?>')"
                        >
                          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 15px; height: 15px;">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                          </svg>
                        </button>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <!-- Table Footer Pagination -->
        <div class="table-footer-bar">
          <div class="table-summary-info">
            <span id="service-summary-text">Showing 1 - 5 of 36 customer service requests across Sri Lanka</span>
          </div>

          <div class="pagination-controls">
            <button class="pagination-btn">&lt; Previous</button>
            <button class="pagination-btn active">1</button>
            <button class="pagination-btn">2</button>
            <button class="pagination-btn">3</button>
            <span class="pagination-ellipsis">&hellip;</span>
            <button class="pagination-btn">8</button>
            <button class="pagination-btn">Next &gt;</button>
          </div>
        </div>
      </section>
    </main>
  </div>
</div>

<!-- Request Audit Dossier Modal -->
<div class="modal-overlay" id="request-detail-modal">
  <div class="modal-card">
    <div class="modal-header">
      <h3 class="modal-title">AI Classification &amp; Audit Breakdown</h3>
      <button class="modal-close-btn" onclick="document.getElementById('request-detail-modal').classList.remove('active');">&times;</button>
    </div>
    <div class="modal-body">
      <div style="background:#FFF5F5; border:1px solid #FECACA; border-radius:8px; padding:12px 16px; margin-bottom:16px;">
        <h4 style="color:#DC2626; font-size:14px; font-weight:700; margin-bottom:4px;">Security &amp; Moderation Flag Raised</h4>
        <p style="font-size:12.5px; color:#991B1B;">This post was flagged due to keyword mismatch with standard Sri Lankan trade categories and duplicate phone patterns.</p>
      </div>

      <div style="background:#F8FAFC; border:1px solid var(--border-color); border-radius:8px; padding:14px; margin-bottom:16px;">
        <div style="display:grid; grid-template-columns: repeat(2, 1fr); gap:10px; font-size:13px;">
          <div><strong>Request ID:</strong> #<span id="modal-req-id">SR-1038</span></div>
          <div><strong>Customer / Author:</strong> <span id="modal-req-customer">Customer</span></div>
          <div><strong>Predicted Trade:</strong> <span id="modal-req-category">Masonry</span></div>
          <div><strong>Confidence Score:</strong> <span id="modal-req-confidence">61%</span></div>
          <div><strong>Urgency Level:</strong> <span id="modal-req-urgency">High</span></div>
          <div><strong>NLP Engine:</strong> <span>Groq Llama-3.3 NLP Pipeline</span></div>
        </div>
        <div style="margin-top:12px; font-size:12.5px;">
          <strong>Request Content:</strong>
          <p id="modal-req-title" style="color:var(--secondary-text); margin-top:4px;">Request text preview...</p>
        </div>
      </div>

      <div style="display:flex; justify-content:flex-end; gap:10px;">
        <button class="filter-pill-btn" onclick="document.getElementById('request-detail-modal').classList.remove('active');" style="padding:8px 16px; border:1px solid var(--border-color);">Close</button>
        <button class="btn-action-remove-solid" onclick="deleteRequestRow(document.getElementById('modal-req-id').textContent); document.getElementById('request-detail-modal').classList.remove('active');">Purge from Marketplace</button>
      </div>
    </div>
  </div>
</div>

<div class="toast-container" id="toast-container"></div>
<script src="../assets/js/admin.js"></script>
</body>
</html>
