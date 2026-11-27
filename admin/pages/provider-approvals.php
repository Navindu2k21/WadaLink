<?php
/**
 * WedaLink Control Center - Provider Approvals Management
 * PHP Admin Implementation matching UI Design Specifications
 */
declare(strict_types=1);

require_once __DIR__ . '/../includes/config.php';

$currentPage = 'approvals';
$pendingCount = getPendingProvidersCount();
$providers = $_SESSION['wedalink_providers'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Provider Approvals Management &bull; <?= htmlspecialchars(APP_NAME) ?></title>
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
      <a href="provider-approvals.php" class="nav-link active">
        <div class="nav-link-content">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path><path d="m9 12 2 2 4-4"></path>
          </svg>
          <span>Provider Approvals</span>
        </div>
        <span class="nav-badge danger" id="nav-pending-badge"><?= $pendingCount ?></span>
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
        <button class="icon-btn-round" title="View Notifications" onclick="showToast('Credential streams synchronized.', 'success');">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
          </svg>
          <span class="badge-dot"></span>
        </button>
        <button class="btn-admin-actions" onclick="showToast('Admin actions toolbar ready.', 'success');">
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
      <!-- Header Row with Breadcrumb & Export Button -->
      <div class="page-header-row">
        <div class="header-title-group">
          <div class="header-meta-stream">
            <span>COMPLIANCE &amp; ONBOARDING &bull; VERIFICATION QUEUE</span>
          </div>
          <h1>Provider Approvals Management</h1>
          <p>Verify identity credentials and background checks for skilled trade professionals across Sri Lanka prior to platform activation.</p>
        </div>

        <div class="header-right-actions">
          <a href="../api/actions.php?action=export_csv" class="btn-primary-action" style="text-decoration:none;" title="Download complete provider directory as CSV">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
              <polyline points="7 10 12 15 17 10"></polyline>
              <line x1="12" y1="15" x2="12" y2="3"></line>
            </svg>
            <span>Export Provider Directory (CSV)</span>
          </a>
        </div>
      </div>

      <!-- Top 4 Status Metric Cards (Icons on Right) -->
      <section class="metric-cards-grid">
        <!-- Card 1: Pending Action -->
        <div class="metric-card-split">
          <div class="metric-card-split-header">
            <span class="metric-eyebrow">PENDING ACTION</span>
            <div class="metric-split-icon red">
              <!-- Hourglass / timer icon -->
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 22h14"></path><path d="M5 2h14"></path>
                <path d="M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22"></path>
                <path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2"></path>
              </svg>
            </div>
          </div>
          <div class="metric-split-body">
            <div class="metric-split-value" id="stat-pending-approvals">05</div>
            <div class="metric-split-sub">4 Western &bull; 1 Central</div>
          </div>
        </div>

        <!-- Card 2: Active Verified -->
        <div class="metric-card-split">
          <div class="metric-card-split-header">
            <span class="metric-eyebrow">ACTIVE VERIFIED</span>
            <div class="metric-split-icon teal">
              <!-- Shield check icon -->
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                <path d="m9 12 2 2 4-4"></path>
              </svg>
            </div>
          </div>
          <div class="metric-split-body">
            <div class="metric-split-value">42</div>
            <div class="metric-split-sub">98.4% SLA Compliance</div>
          </div>
        </div>

        <!-- Card 3: Under Investigation -->
        <div class="metric-card-split">
          <div class="metric-card-split-header">
            <span class="metric-eyebrow">UNDER INVESTIGATION</span>
            <div class="metric-split-icon orange">
              <!-- Warning / Audit strike icon -->
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"></path>
                <line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line>
              </svg>
            </div>
          </div>
          <div class="metric-split-body">
            <div class="metric-split-value">03</div>
            <div class="metric-split-sub">NIC Mismatch / Audit</div>
          </div>
        </div>

        <!-- Card 4: Sri Lanka Coverage -->
        <div class="metric-card-split">
          <div class="metric-card-split-header">
            <span class="metric-eyebrow">SRI LANKA COVERAGE</span>
            <div class="metric-split-icon blue">
              <!-- Map pin icon -->
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                <circle cx="12" cy="10" r="3"></circle>
              </svg>
            </div>
          </div>
          <div class="metric-split-body">
            <div class="metric-split-value">9 Provinces</div>
            <div class="metric-split-sub">Colombo hub dense</div>
          </div>
        </div>
      </section>

      <!-- Main White Card Container: Table & Filters -->
      <section class="table-card-container">
        <!-- Table Toolbar Filter Bar -->
        <div class="table-toolbar-row">
          <div class="table-tabs-group">
            <button class="table-tab-btn active" data-tab="pending">
              <span>Pending Approvals</span>
              <span class="table-tab-badge" id="box-pending-badge"><?= $pendingCount ?></span>
            </button>
            <button class="table-tab-btn" data-tab="approved">
              <span>Approved Providers</span>
            </button>
          </div>

          <div class="table-controls-right">
            <!-- Search Input -->
            <div class="table-search-box">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
              </svg>
              <input 
                type="text" 
                id="table-search-input" 
                placeholder="Search by provider name, mobile, NIC, or city..."
              >
            </div>

            <!-- Categories Dropdown -->
            <select class="table-select" id="category-filter-select">
              <option value="all">All Categories</option>
              <option value="Electrician">Electrician</option>
              <option value="Plumber">Plumber</option>
              <option value="AC Technician">AC Technician</option>
              <option value="Carpenter & Woodworker">Carpenter &amp; Woodworker</option>
            </select>

            <!-- Cities Dropdown -->
            <select class="table-select" id="city-filter-select">
              <option value="all">All Cities</option>
              <option value="Colombo">Colombo</option>
              <option value="Kandy">Kandy</option>
              <option value="Kurunegala">Kurunegala</option>
              <option value="Gampaha">Gampaha</option>
              <option value="Negombo">Negombo</option>
              <option value="Moratuwa">Moratuwa</option>
            </select>

            <!-- Filter Icon Button -->
            <button class="btn-filter-icon" title="Reset / Filter Options" onclick="document.getElementById('table-search-input').value=''; document.getElementById('category-filter-select').value='all'; document.getElementById('city-filter-select').value='all'; setupApprovalsTableFilters();">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
              </svg>
            </button>
          </div>
        </div>

        <!-- Data Table -->
        <div class="table-responsive">
          <table class="approvals-data-table">
            <thead>
              <tr>
                <th>PROVIDER DETAILS</th>
                <th>TRADE &amp; SPECIALIZATION</th>
                <th>CONTACT (SRI LANKA)</th>
                <th>CITY &amp; PROVINCE</th>
                <th>EXPERIENCE</th>
                <th>REGISTERED</th>
                <th>STATUS</th>
                <th style="text-align: right;">ACTIONS</th>
              </tr>
            </thead>
            <tbody id="approvals-table-body">
              <?php foreach ($providers as $p): ?>
                <tr 
                  id="provider-row-<?= $p['id'] ?>"
                  data-status="<?= htmlspecialchars($p['status']) ?>"
                  data-category="<?= htmlspecialchars($p['trade']) ?>"
                  data-city="<?= htmlspecialchars($p['city'] ?? '') ?>"
                >
                  <!-- Provider Details -->
                  <td>
                    <div class="table-provider-col">
                      <div class="avatar-initials-badge <?= htmlspecialchars($p['initials_color'] ?? 'blue') ?>">
                        <?= htmlspecialchars($p['initials'] ?? 'KP') ?>
                      </div>
                      <div class="table-provider-info">
                        <span class="table-provider-name"><?= htmlspecialchars($p['name']) ?></span>
                        <span class="table-provider-nic">NIC: <?= htmlspecialchars($p['nic'] ?? '198923401928') ?></span>
                      </div>
                    </div>
                  </td>

                  <!-- Trade & Specialization -->
                  <td>
                    <div class="table-trade-col">
                      <span class="table-trade-title">
                        <?php if (str_contains($p['trade'], 'Electrician')): ?>
                          <!-- Spark / Electric icon -->
                          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                          </svg>
                        <?php elseif (str_contains($p['trade'], 'Plumber')): ?>
                          <!-- Wrench icon -->
                          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                          </svg>
                        <?php elseif (str_contains($p['trade'], 'AC')): ?>
                          <!-- Snowflake / AC icon -->
                          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2v20M2 12h20M4.93 4.93l14.14 14.14M4.93 19.07l14.14-14.14"></path>
                          </svg>
                        <?php else: ?>
                          <!-- Tool icon -->
                          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                          </svg>
                        <?php endif; ?>
                        <?= htmlspecialchars($p['trade']) ?>
                      </span>
                      <span class="table-trade-sub"><?= htmlspecialchars($p['specialization'] ?? '') ?></span>
                    </div>
                  </td>

                  <!-- Contact -->
                  <td>
                    <span class="table-contact-val">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                      </svg>
                      <?= htmlspecialchars($p['phone']) ?>
                    </span>
                  </td>

                  <!-- City & Province -->
                  <td>
                    <div class="table-city-col">
                      <span class="table-city-title"><?= htmlspecialchars($p['city'] ?? $p['location']) ?></span>
                      <span class="table-province-sub"><?= htmlspecialchars($p['province'] ?? 'Western Province') ?></span>
                    </div>
                  </td>

                  <!-- Experience -->
                  <td>
                    <span class="table-exp-text"><?= htmlspecialchars($p['experience']) ?></span>
                  </td>

                  <!-- Registered -->
                  <td>
                    <div class="table-reg-col">
                      <span class="table-reg-day"><?= htmlspecialchars($p['registered_day'] ?? 'Today') ?></span>
                      <span class="table-reg-time"><?= htmlspecialchars($p['registered_time'] ?? '09:30 AM') ?></span>
                    </div>
                  </td>

                  <!-- Status -->
                  <td>
                    <?php if ($p['status'] === 'pending'): ?>
                      <span class="table-status-pill pending">
                        <span class="status-indicator-dot"></span>
                        Pending Verification
                      </span>
                    <?php elseif ($p['status'] === 'approved'): ?>
                      <span class="table-status-pill approved">
                        <span class="status-indicator-dot"></span>
                        Approved
                      </span>
                    <?php else: ?>
                      <span class="table-status-pill pending" style="color:#DC2626;">
                        <span class="status-indicator-dot" style="background:#DC2626;"></span>
                        Suspended
                      </span>
                    <?php endif; ?>
                  </td>

                  <!-- Actions -->
                  <td>
                    <div class="table-actions-group">
                      <?php if ($p['status'] === 'pending'): ?>
                        <button 
                          type="button" 
                          class="btn-tbl-approve" 
                          title="Approve Provider" 
                          onclick="approveProvider(<?= $p['id'] ?>, '<?= addslashes($p['name']) ?>')"
                        >
                          <span>&check;</span> Approve
                        </button>
                        <button 
                          type="button" 
                          class="btn-tbl-reject" 
                          title="Reject Application" 
                          onclick="rejectProvider(<?= $p['id'] ?>, '<?= addslashes($p['name']) ?>')"
                        >
                          <span>&times;</span> Reject
                        </button>
                        <button 
                          type="button" 
                          class="btn-tbl-view" 
                          title="View Full Credentials" 
                          onclick="viewProviderModal('<?= addslashes($p['name']) ?>', '<?= addslashes($p['nic'] ?? '') ?>', '<?= addslashes($p['trade']) ?>', '<?= addslashes($p['experience']) ?>', '<?= addslashes($p['phone']) ?>', '<?= addslashes($p['city'] ?? '') ?>', 'Pending Verification')"
                        >
                          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 16px; height: 16px;">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                          </svg>
                        </button>
                      <?php else: ?>
                        <button 
                          type="button" 
                          class="btn-tbl-profile" 
                          onclick="viewProviderModal('<?= addslashes($p['name']) ?>', '<?= addslashes($p['nic'] ?? '') ?>', '<?= addslashes($p['trade']) ?>', '<?= addslashes($p['experience']) ?>', '<?= addslashes($p['phone']) ?>', '<?= addslashes($p['city'] ?? '') ?>', 'Approved')"
                        >
                          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 14px; height: 14px;">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                          </svg>
                          <span>View Profile</span>
                        </button>
                        <button 
                          type="button" 
                          class="btn-tbl-suspend" 
                          title="Suspend account" 
                          onclick="suspendProvider(<?= $p['id'] ?>, '<?= addslashes($p['name']) ?>')"
                        >
                          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 14px; height: 14px;">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line>
                          </svg>
                          <span>Suspend</span>
                        </button>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <!-- Table Footer with Pagination -->
        <div class="table-footer-bar">
          <div class="table-summary-info">
            <span id="table-showing-summary">Showing 1 to 6 of 50 registered providers</span>
            <span class="table-sync-tag">
              &bull; 
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width: 13px; height: 13px;">
                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
              </svg>
              Realtime Sync Active
            </span>
          </div>

          <div class="pagination-controls">
            <button class="pagination-btn">&lt; Previous</button>
            <button class="pagination-btn active">1</button>
            <button class="pagination-btn">2</button>
            <button class="pagination-btn">3</button>
            <span class="pagination-ellipsis">&hellip;</span>
            <button class="pagination-btn">5</button>
            <button class="pagination-btn">Next &gt;</button>
          </div>
        </div>
      </section>

      <!-- Bottom Verification Guidelines & Policy Cards -->
      <section class="policy-cards-grid">
        <!-- Card 1: NVQ Level 3 / 4 Verification -->
        <article class="policy-card">
          <div>
            <div class="policy-header">
              <!-- Graduation / Certificate badge icon -->
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
              </svg>
              <span>NVQ Level 3 / 4 Verification</span>
            </div>
            <p class="policy-desc">
              Cross-referenced with TVEC Sri Lanka database. Ensure provider certificates have verifiable QR codes and trade institute stamps.
            </p>
          </div>
          <div class="policy-footer">
            <span class="policy-sync-status">API Sync: Online (TVEC Gateway)</span>
            <!-- Shield icon -->
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
            </svg>
          </div>
        </article>

        <!-- Card 2: Grama Niladhari Certificate -->
        <article class="policy-card">
          <div>
            <div class="policy-header">
              <!-- Document seal icon -->
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
              </svg>
              <span>Grama Niladhari Certificate</span>
            </div>
            <p class="policy-desc">
              Address verification requires a divisional secretariat certified certificate issued within the past 6 months for Colombo and Western zones.
            </p>
          </div>
          <div class="policy-footer">
            <span class="policy-sync-status">Policy Rev. 2024.1</span>
            <!-- Stamp icon -->
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="4"></circle>
              <path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path>
            </svg>
          </div>
        </article>
      </section>
    </main>
  </div>
</div>

<!-- Provider Full Credentials Inspection Modal -->
<div class="modal-overlay" id="provider-detail-modal">
  <div class="modal-card">
    <div class="modal-header">
      <h3 class="modal-title">Provider Verification Dossier</h3>
      <button class="modal-close-btn" onclick="document.getElementById('provider-detail-modal').classList.remove('active');">&times;</button>
    </div>
    <div class="modal-body">
      <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 18px;">
        <div class="avatar-initials-badge blue" style="width: 48px; height: 48px; font-size: 16px;">
          <span>PRO</span>
        </div>
        <div>
          <h4 id="modal-provider-name" style="font-size: 16px; font-weight: 700;">Provider Name</h4>
          <span id="modal-provider-nic" style="font-size: 12px; color: var(--muted-text);">NIC: 000000000000</span>
        </div>
      </div>

      <div style="background:#F8FAFC; border:1px solid var(--border-color); border-radius:8px; padding:14px; margin-bottom:16px;">
        <div style="display:grid; grid-template-columns: repeat(2, 1fr); gap:12px; font-size:13px;">
          <div><strong>Trade:</strong> <span id="modal-provider-trade">Trade</span></div>
          <div><strong>Experience:</strong> <span id="modal-provider-exp">Experience</span></div>
          <div><strong>Contact:</strong> <span id="modal-provider-phone">+94 7X XXX XXXX</span></div>
          <div><strong>City &amp; Province:</strong> <span id="modal-provider-city">City</span></div>
          <div><strong>Verification State:</strong> <span id="modal-provider-status">Pending</span></div>
          <div><strong>TVEC Sri Lanka Check:</strong> <span style="color:#16A34A; font-weight:600;">✓ QR Validated</span></div>
        </div>
      </div>

      <div style="display: flex; justify-content: flex-end; gap: 10px;">
        <button class="filter-pill-btn" onclick="document.getElementById('provider-detail-modal').classList.remove('active');" style="padding: 8px 16px; border: 1px solid var(--border-color);">Close</button>
        <button class="btn-primary-action" onclick="showToast('Credentials marked as verified.', 'success'); document.getElementById('provider-detail-modal').classList.remove('active');">Confirm Verification</button>
      </div>
    </div>
  </div>
</div>

<!-- Toast Container -->
<div class="toast-container" id="toast-container"></div>

<script src="../assets/js/admin.js"></script>
</body>
</html>
