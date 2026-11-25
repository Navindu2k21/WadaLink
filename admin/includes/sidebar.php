<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
$pendingCount = getPendingProvidersCount();
?>
<aside class="sidebar">
  <div class="brand-section">
    <div class="brand-logo-icon">
      <!-- Toolbox / Wrench icon -->
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
    <!-- Overview & Stats -->
    <a href="index.php" class="nav-link <?= ($currentPage === 'overview') ? 'active' : '' ?>">
      <div class="nav-link-content">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="3" width="7" height="7"></rect>
          <rect x="14" y="3" width="7" height="7"></rect>
          <rect x="14" y="14" width="7" height="7"></rect>
          <rect x="3" y="14" width="7" height="7"></rect>
        </svg>
        <span>Overview &amp; Stats</span>
      </div>
    </a>

    <!-- Provider Approvals -->
    <a href="pages/provider-approvals.php" class="nav-link <?= ($currentPage === 'approvals') ? 'active' : '' ?>">
      <div class="nav-link-content">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
          <path d="m9 12 2 2 4-4"></path>
        </svg>
        <span>Provider Approvals</span>
      </div>
      <span class="nav-badge danger" id="nav-pending-badge"><?= $pendingCount ?></span>
    </a>

    <!-- Service Listings -->
    <a href="pages/service-listings.php" class="nav-link <?= ($currentPage === 'listings') ? 'active' : '' ?>">
      <div class="nav-link-content">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
          <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
        </svg>
        <span>Service Listings</span>
      </div>
    </a>

    <!-- Equipment Rentals -->
    <a href="pages/equipment-rentals.php" class="nav-link <?= ($currentPage === 'equipment') ? 'active' : '' ?>">
      <div class="nav-link-content">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
        </svg>
        <span>Equipment Rentals</span>
      </div>
    </a>

    <!-- Reviews & Reports -->
    <a href="pages/reviews-reports.php" class="nav-link <?= ($currentPage === 'reviews') ? 'active' : '' ?>">
      <div class="nav-link-content">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"></circle>
          <line x1="12" y1="8" x2="12" y2="12"></line>
          <line x1="12" y1="16" x2="12.01" y2="16"></line>
        </svg>
        <span>Reviews &amp; Reports</span>
      </div>
    </a>

    <!-- Activity Logs -->
    <a href="pages/activity-logs.php" class="nav-link <?= ($currentPage === 'logs') ? 'active' : '' ?>">
      <div class="nav-link-content">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"></circle>
          <polyline points="12 6 12 12 16 14"></polyline>
        </svg>
        <span>Activity Logs</span>
      </div>
    </a>
  </nav>

  <!-- Sidebar Footer / Admin Identity -->
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
          <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
          <polyline points="16 17 21 12 16 7"></polyline>
          <line x1="21" y1="12" x2="9" y2="12"></line>
        </svg>
      </button>
    </div>
  </div>
</aside>
