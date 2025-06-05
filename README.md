# mod_bears_pricing_tables
Responsive pricing tables for Joomla 

## Template Designer's Guide - CSS Variables

This guide lists all CSS variables used in the Bears Pricing Tables module and explains their function.

### Global Variables (from global.css)
These variables are defined in global.css and provide default values that can be overridden by specific templates:

#### Typography Base Sizes
| Variable | Function |
|----------|----------|
| `--bears-h1` | Base size for h1 elements (2.5rem) |
| `--bears-h2` | Base size for h2 elements (2rem) |
| `--bears-h3` | Base size for h3 elements (1.75rem) |
| `--bears-h4` | Base size for h4 elements (1.5rem) |
| `--bears-body` | Base size for body text (1rem) |

### Icon Variables (from icons.css)
These variables are defined in icons.css and control the appearance of icons in different columns:

#### Column-Specific Icon Styling
| Variable | Function |
|----------|----------|
| `--bears-header-icon-color-1` | Icon color for column 1 (defaults to `--bears-header-icon-color`) |
| `--bears-header-icon-size-1` | Icon size for column 1 (defaults to `--bears-header-icon-size`) |
| `--bears-header-icon-color-2` | Icon color for column 2 (defaults to `--bears-header-icon-color`) |
| `--bears-header-icon-size-2` | Icon size for column 2 (defaults to `--bears-header-icon-size`) |
| `--bears-header-icon-color-3` | Icon color for column 3 (defaults to `--bears-header-icon-color`) |
| `--bears-header-icon-size-3` | Icon size for column 3 (defaults to `--bears-header-icon-size`) |
| `--bears-header-icon-color-4` | Icon color for column 4 (defaults to `--bears-header-icon-color`) |
| `--bears-header-icon-size-4` | Icon size for column 4 (defaults to `--bears-header-icon-size`) |
| `--bears-header-icon-color-5` | Icon color for column 5 (defaults to `--bears-header-icon-color`) |
| `--bears-header-icon-size-5` | Icon size for column 5 (defaults to `--bears-header-icon-size`) |

### Common Template Variables
These variables are used across all templates but may have different values in each template:

#### Layout & Structure
| Variable | Function |
|----------|----------|
| `--bears-num-columns` | Defines the number of pricing columns to display |
| `--bears-column-margin-y` | Sets the vertical margin between pricing columns |
| `--bears-column-margin-x` | Sets the horizontal margin between pricing columns |

#### Typography
| Variable | Function |
|----------|----------|
| `--bears-title-font-family` | Font family for pricing plan titles |
| `--bears-price-font-family` | Font family for pricing amounts |
| `--bears-title-font-weight` | Font weight for pricing plan titles |
| `--bears-price-font-weight` | Font weight for pricing amounts |
| `--bears-title-font-size` | Font size for pricing plan titles (references `--bears-h4`) |
| `--bears-price-font-size` | Font size for pricing amounts (references `--bears-h1`) |
| `--bears-subtitle-font-size` | Font size for subtitles (references `--bears-h4`) |
| `--bears-features-font-size` | Font size for feature list items (references `--bears-body`) |
| `--bears-button-font-size` | Font size for buttons (references `--bears-body`) |

#### Colors - Standard Elements
| Variable | Function |
|----------|----------|
| `--bears-column-background` | Background color for pricing columns |
| `--bears-header-background` | Background color for column headers |
| `--bears-features-background-odd` | Background color for odd-numbered feature rows |
| `--bears-features-background-even` | Background color for even-numbered feature rows |
| `--bears-featured-features-background-odd` | Background color for odd-numbered feature rows in featured columns |
| `--bears-featured-features-background-even` | Background color for even-numbered feature rows in featured columns |

#### Colors - Text
| Variable | Function |
|----------|----------|
| `--bears-title-color` | Text color for pricing plan titles |
| `--bears-price-color` | Text color for pricing amounts |
| `--bears-subtitle-color` | Text color for subtitles (references `--bears-price-color`) |
| `--bears-features-text-color` | Text color for feature list items |
| `--bears-button-text-color` | Text color for buttons |

#### Colors - Featured Elements
| Variable | Function |
|----------|----------|
| `--bears-column-featured-background` | Background color for featured pricing columns |
| `--bears-header-featured-background` | Background color for featured column headers |
| `--bears-featured-title-color` | Text color for featured pricing plan titles |
| `--bears-featured-price-color` | Text color for featured pricing amounts |
| `--bears-featured-subtitle-color` | Text color for subtitles in featured columns |
| `--bears-featured-features-text-color` | Text color for featured column feature list items |

#### Colors - Buttons
| Variable | Function |
|----------|----------|
| `--bears-button-background-color` | Background color for buttons |
| `--bears-button-hover-color` | Background color for buttons on hover |
| `--bears-featured-button-background` | Background color for buttons in featured columns |
| `--bears-featured-button-text-color` | Text color for buttons in featured columns |

#### Borders - Standard
| Variable | Function |
|----------|----------|
| `--bears-border-style` | Border style for pricing columns |
| `--bears-border-width` | Border width for pricing columns |
| `--bears-border-radius` | Border radius for pricing columns |
| `--bears-border-color` | Border color for pricing columns |
| `--bears-header-border` | Border style for column headers |

#### Borders - Buttons
| Variable | Function |
|----------|----------|
| `--bears-button-border-radius` | Border radius for buttons |

#### Borders - Featured
| Variable | Function |
|----------|----------|
| `--bears-featured-border-radius` | Border radius for featured pricing columns |
| `--bears-featured-border-width` | Border width for featured pricing columns |
| `--bears-featured-border-style` | Border style for featured pricing columns (references `--bears-border-style`) |
| `--bears-featured-border-color` | Border color for featured pricing columns |

#### Effects & Animation
| Variable | Function |
|----------|----------|
| `--bears-accent-color` | Accent color for highlighting elements |
| `--bears-featured-accent-color` | Accent color for highlighting elements in featured columns |
| `--bears-transition-speed` | Duration of transition animations |
| `--bears-scale-amount` | Scale factor for hover effects |
| `--bears-box-shadow` | Box shadow for pricing columns |
| `--bears-featured-box-shadow` | Box shadow for featured pricing columns |

#### Icons
| Variable | Function |
|----------|----------|
| `--bears-header-icon-color` | Color for icons in column headers |
| `--bears-featured-header-icon-color` | Color for icons in featured column headers |
| `--bears-features-icon-color` | Color for icons in feature list items (references `--bears-features-text-color`) |
| `--bears-featured-features-icon-color` | Color for icons in featured column feature list items (references `--bears-featured-features-text-color`) |
| `--bears-header-icon-size` | Size for icons in column headers |
