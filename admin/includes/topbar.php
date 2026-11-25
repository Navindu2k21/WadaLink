<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
?>
<header class="topbar">
  <!-- Search Field -->
  <div class="search-container">
    <div class="search-icon">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="11" cy="11" r="8"></circle>
        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
      </svg>
    </div>
    <input 
      type="text" 
      class="search-input" 
      placeholder="Search providers, requests, equipment in Sri Lanka..."
      autocomplete="off"
    >
  </div>

  <!-- Topbar Action Pill Group -->
  <div class="topbar-actions">
    <!-- Operational Status Pill -->
    <div class="status-pill">
      <span class="status-dot"></span>
      <span>System Operational &bull; Sri Lanka</span>
    </div>

    <!-- Notification Bell -->
    <button class="icon-btn-round" title="View Notifications" onclick="showToast('Dispatch streams normal across all 9 provinces.', 'success');">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
      </svg>
      <span class="badge-dot"></span>
    </button>

    <!-- Admin Actions Button -->
    <button class="btn-admin-actions" onclick="showToast('Quick maintenance tools loaded.', 'success');">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
      </svg>
      <span>Admin Actions</span>
    </button>

    <!-- Profile Icon Button -->
    <button class="user-profile-button" title="Admin Profile">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 18px; height: 18px;">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
        <circle cx="12" cy="7" r="4"></circle>
      </svg>
    </button>
  </div>
</header>
