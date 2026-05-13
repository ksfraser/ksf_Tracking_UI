# Tracking UI - Architecture

## Document Information

| Field | Value |
|-------|-------|
| **Module Name** | ksf_Tracking_UI |
| **Module Type** | UI Adapter |
| **Platform** | FrontAccounting |
| **Version** | 1.0.0 |

---

## 1. Technical Architecture

### 1.1 Architecture Pattern

```
┌──────────────────────────────────────────────────────────────────────┐
│                    ksf_Tracking_UI                                    │
│                 (FrontAccounting UI Adapter)                           │
├──────────────────────────────────────────────────────────────────────┤
│                                                                      │
│  ┌──────────────────────────────────────────────────────────────┐     │
│  │                 tracking.php (FA Page)                       │     │
│  │  Responsibilities:                                          │     │
│  │  - Fetch tracking statistics                                │     │
│  │  - Render statistics display                                │     │
│  │  - FA page integration                                      │     │
│  └──────────────────────────────────────────────────────────────┘     │
│                                                                      │
├──────────────────────────────────────────────────────────────────────┤
│                         FrontAccounting Platform                      │
│  ┌────────────────┐  ┌────────────────┐  ┌────────────────┐           │
│  │   UI.inc       │  │  session.inc  │  │tracking_db.inc │           │
│  │   page()      │  │  page_security│  │get_tracking_  │           │
│  │               │  │  SA_TRACKING  │  │  stats()       │           │
│  └────────────────┘  └────────────────┘  └────────────────┘           │
└──────────────────────────────────────────────────────────────────────┘
```

### 1.2 Directory Structure

```
ksf_Tracking_UI/
├── pages/
│   └── tracking.php    # FA page entry point
├── tests/
├── ProjectDcs/
└── README.md
```

### 1.3 Page Flow

```
┌──────────────┐    ┌──────────────────┐    ┌──────────────────┐
│   Browser    │    │  tracking.php    │    │  tracking_db.inc │
│             │    │                  │    │                  │
└──────┬───────┘    └────────┬─────────┘    └───────┬──────────┘
       │                     │                        │
       │  GET /tracking.php  │                        │
       │───────────────────▶│                        │
       │                    │                        │
       │                    │  get_tracking_stats()  │
       │                    │───────────────────────▶│
       │                    │                        │
       │                    │  [stats array]        │
       │                    │◀──────────────────────│
       │                    │                        │
       │                    │  Render Stats         │
       │                    │                        │
       │  [HTML Page]        │                        │
       │◀───────────────────│                        │
       │                    │                        │
```

---

## 2. Data Flow

### 2.1 Statistics Input

```php
// From get_tracking_stats()
$stats = [
    'visitors' => 1250,
    'events' => 5430
];
```

### 2.2 Output Structure

```php
echo "<b>Visitors:</b> " . ($stats['visitors'] ?? 0) . "<br>";
echo "<b>Events:</b> " . ($stats['events'] ?? 0) . "<br>";
```

---

## 3. Integration Points

| Function | Source | Purpose |
|----------|--------|---------|
| page() | FA UI.inc | Initialize FA page |
| get_tracking_stats() | FA_Tracking/includes/tracking_db.inc | Fetch stats |
| end_page() | FA UI.inc | Close page |

---

*Document Version: 1.0.0*  
*Author: KSFII Development Team*