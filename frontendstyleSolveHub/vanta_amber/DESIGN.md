---
name: Vanta Amber
colors:
  surface: '#131313'
  surface-dim: '#131313'
  surface-bright: '#3a3939'
  surface-container-lowest: '#0e0e0e'
  surface-container-low: '#1c1b1b'
  surface-container: '#201f1f'
  surface-container-high: '#2a2a2a'
  surface-container-highest: '#353534'
  on-surface: '#e5e2e1'
  on-surface-variant: '#d8c3ad'
  inverse-surface: '#e5e2e1'
  inverse-on-surface: '#313030'
  outline: '#a08e7a'
  outline-variant: '#534434'
  surface-tint: '#ffb95f'
  primary: '#ffc174'
  on-primary: '#472a00'
  primary-container: '#f59e0b'
  on-primary-container: '#613b00'
  inverse-primary: '#855300'
  secondary: '#c8c6c5'
  on-secondary: '#303030'
  secondary-container: '#474746'
  on-secondary-container: '#b7b5b4'
  tertiary: '#8fd5ff'
  on-tertiary: '#00344a'
  tertiary-container: '#1abdff'
  on-tertiary-container: '#004966'
  error: '#ffb4ab'
  on-error: '#690005'
  error-container: '#93000a'
  on-error-container: '#ffdad6'
  primary-fixed: '#ffddb8'
  primary-fixed-dim: '#ffb95f'
  on-primary-fixed: '#2a1700'
  on-primary-fixed-variant: '#653e00'
  secondary-fixed: '#e4e2e1'
  secondary-fixed-dim: '#c8c6c5'
  on-secondary-fixed: '#1b1c1c'
  on-secondary-fixed-variant: '#474746'
  tertiary-fixed: '#c5e7ff'
  tertiary-fixed-dim: '#7fd0ff'
  on-tertiary-fixed: '#001e2d'
  on-tertiary-fixed-variant: '#004c6a'
  background: '#131313'
  on-background: '#e5e2e1'
  surface-variant: '#353534'
typography:
  headline-lg:
    fontFamily: Geist
    fontSize: 32px
    fontWeight: '600'
    lineHeight: '1.2'
    letterSpacing: -0.02em
  headline-md:
    fontFamily: Geist
    fontSize: 24px
    fontWeight: '600'
    lineHeight: '1.3'
    letterSpacing: -0.01em
  headline-sm:
    fontFamily: Geist
    fontSize: 20px
    fontWeight: '500'
    lineHeight: '1.4'
    letterSpacing: '0'
  body-lg:
    fontFamily: Geist
    fontSize: 16px
    fontWeight: '400'
    lineHeight: '1.6'
    letterSpacing: '0'
  body-md:
    fontFamily: Geist
    fontSize: 14px
    fontWeight: '400'
    lineHeight: '1.5'
    letterSpacing: '0'
  label-md:
    fontFamily: Geist
    fontSize: 12px
    fontWeight: '500'
    lineHeight: '1'
    letterSpacing: 0.05em
  label-sm:
    fontFamily: Geist
    fontSize: 10px
    fontWeight: '600'
    lineHeight: '1'
    letterSpacing: 0.1em
  headline-lg-mobile:
    fontFamily: Geist
    fontSize: 24px
    fontWeight: '600'
    lineHeight: '1.2'
rounded:
  sm: 0.125rem
  DEFAULT: 0.25rem
  md: 0.375rem
  lg: 0.5rem
  xl: 0.75rem
  full: 9999px
spacing:
  base_unit: 4px
  gutter: 24px
  margin_mobile: 16px
  margin_desktop: 48px
  container_max_width: 1280px
---

## Brand & Style
The design system moves away from the approachable calm of its predecessor toward a high-contrast, industrial aesthetic. It evokes the feeling of a high-end precision instrument or a sophisticated developer environment. The personality is authoritative, focused, and utilitarian, yet executed with premium refinement.

The style is **High-Contrast Minimalism** with a **Technical** edge. It utilizes deep blacks to create a void-like depth, allowing the warm amber accents to pop with functional urgency. Whitespace is used not just for breathing room, but as a structural element to frame dense information. The emotional response is one of absolute clarity and professional focus.

## Colors
The palette is dominated by "Vanta" levels of black and charcoal, creating a sophisticated backdrop for industrial amber.

- **Primary Amber (#f59e0b):** Used exclusively for primary actions, critical states, and active indicators. It represents heat, energy, and focus.
- **Surface Tiers:** We utilize a triple-black strategy. The base `background` is pure hex #000000. `surface` and `surface_dim` sit at #0a0a0a to provide the slightest hint of structure, while `surface_bright` (#262626) acts as a raised "container" or "toolbar" layer.
- **Contrast:** Content is rendered in high-contrast off-whites (#f5f5f5) to ensure maximum legibility against the dark void.

## Typography
This design system utilizes **Geist** exclusively to maintain a monolinear, technical appearance. 

The typographic hierarchy relies on weight and letter spacing rather than just size. Headlines use tighter tracking and heavier weights for a "blocked" industrial feel. Labels are frequently set in uppercase with increased tracking to mimic technical diagrams and blueprints. Body text prioritizes legibility with generous line heights to offset the high-contrast color scheme.

## Layout & Spacing
The layout follows a **Rigid Grid** philosophy. Content is organized into a 12-column system on desktop and a 4-column system on mobile. 

Spacing is strictly mathematical, built on a 4px baseline. This precision reinforces the industrial nature of the system. Gutters are kept wide (24px) to ensure that even in data-dense views, the interface feels structured rather than cluttered. Components should snap to the grid, avoiding fluid or organic placements.

## Elevation & Depth
In a near-black environment, traditional shadows are ineffective. Instead, this design system uses **Tonal Layering** and **Edge Illumination**.

- **Depth through Lume:** Elevation is signaled by shifting from #000000 up to #262626.
- **Hairline Outlines:** Instead of shadows, elevated elements like cards or menus use a 1px solid border (#262626 or #404040). 
- **Active Glow:** Interactive elements in an "active" or "focused" state may use a subtle, low-spread outer glow using the primary Amber color to simulate a backlit display.

## Shapes
To align with the "Round Four" (4px) requirement in an industrial context, the design system utilizes **Soft** geometry. 

The 4px radius (`roundedness: 1`) is applied to all standard components—buttons, inputs, and cards. This slight rounding prevents the UI from feeling hostile or overly "brutalist," providing a hint of modern manufacturing precision (like machined aluminum) without veering into the "bubbly" territory of consumer social apps.

## Components
- **Buttons:** Primary buttons are solid Amber (#f59e0b) with black text. Secondary buttons are outlined with #262626 and white text. All buttons use the 4px radius.
- **Input Fields:** Backgrounds are pure black (#000000) with a 1px border of #262626. On focus, the border turns Amber.
- **Cards:** Use `surface_bright` (#262626) or a simple hairline stroke on `surface_dim`. No shadows.
- **Chips/Badges:** Small, technical-looking tags with `label-sm` typography. Often used for status indicators (e.g., "STABLE", "ACTIVE").
- **Lists:** Separated by 1px hairlines of #171717. Interaction states use a subtle background shift to #171717.
- **Data Visuals:** Charts and graphs must use Amber as the primary data line, with neutral grays for secondary data, maintaining the high-contrast industrial theme.