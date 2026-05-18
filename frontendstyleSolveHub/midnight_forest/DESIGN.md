---
name: Midnight Forest
colors:
  surface: '#051424'
  surface-dim: '#051424'
  surface-bright: '#2c3a4c'
  surface-container-lowest: '#010f1f'
  surface-container-low: '#0d1c2d'
  surface-container: '#122131'
  surface-container-high: '#1c2b3c'
  surface-container-highest: '#273647'
  on-surface: '#d4e4fa'
  on-surface-variant: '#bbcabf'
  inverse-surface: '#d4e4fa'
  inverse-on-surface: '#233143'
  outline: '#86948a'
  outline-variant: '#3c4a42'
  surface-tint: '#4edea3'
  primary: '#4edea3'
  on-primary: '#003824'
  primary-container: '#10b981'
  on-primary-container: '#00422b'
  inverse-primary: '#006c49'
  secondary: '#45dfa4'
  on-secondary: '#003825'
  secondary-container: '#00bd85'
  on-secondary-container: '#00452e'
  tertiary: '#95d3ba'
  on-tertiary: '#003829'
  tertiary-container: '#71af97'
  on-tertiary-container: '#004231'
  error: '#ffb4ab'
  on-error: '#690005'
  error-container: '#93000a'
  on-error-container: '#ffdad6'
  primary-fixed: '#6ffbbe'
  primary-fixed-dim: '#4edea3'
  on-primary-fixed: '#002113'
  on-primary-fixed-variant: '#005236'
  secondary-fixed: '#68fcbf'
  secondary-fixed-dim: '#45dfa4'
  on-secondary-fixed: '#002114'
  on-secondary-fixed-variant: '#005137'
  tertiary-fixed: '#b0f0d6'
  tertiary-fixed-dim: '#95d3ba'
  on-tertiary-fixed: '#002117'
  on-tertiary-fixed-variant: '#0b513d'
  background: '#051424'
  on-background: '#d4e4fa'
  surface-variant: '#273647'
typography:
  headline-lg:
    fontFamily: Geist
    fontSize: 48px
    fontWeight: '600'
    lineHeight: 56px
    letterSpacing: -0.02em
  headline-lg-mobile:
    fontFamily: Geist
    fontSize: 32px
    fontWeight: '600'
    lineHeight: 40px
    letterSpacing: -0.02em
  headline-md:
    fontFamily: Geist
    fontSize: 32px
    fontWeight: '500'
    lineHeight: 40px
    letterSpacing: -0.01em
  headline-sm:
    fontFamily: Geist
    fontSize: 24px
    fontWeight: '500'
    lineHeight: 32px
  body-lg:
    fontFamily: Geist
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: Geist
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  body-sm:
    fontFamily: Geist
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 20px
  label-md:
    fontFamily: Geist
    fontSize: 12px
    fontWeight: '600'
    lineHeight: 16px
    letterSpacing: 0.05em
  code:
    fontFamily: Geist
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 20px
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  base: 8px
  xs: 4px
  sm: 12px
  md: 24px
  lg: 40px
  xl: 64px
  gutter: 24px
  margin-mobile: 16px
  margin-desktop: 48px
---

## Brand & Style
The design system embodies "Organic Tech"—a synthesis of high-performance technical precision and the deep, immersive atmosphere of a nocturnal woodland. It is designed for developers, engineers, and creatives who value focus, calm, and a sophisticated aesthetic that moves away from sterile corporate blues toward a more vital, living palette.

The visual style is **Minimalist** with a focus on high-quality typography and subtle tonal layering. It avoids unnecessary decoration, relying instead on the vibrant contrast between the deep background and the luminous primary accents to guide the user's eye. The emotional response is one of "Quiet Confidence": steady, reliable, and deeply focused.

## Colors
The palette is rooted in the "Midnight Forest" concept, utilizing a high-contrast dark scheme. The primary color is a vibrant **Emerald Green**, used sparingly for critical actions and brand moments to ensure it retains its impact.

- **Primary:** #10b981 (Emerald) serves as the "source of light" in the interface.
- **Surface:** #06100d is the foundational dark layer, providing a deep, ink-like canvas.
- **Surface-Bright:** #1a2e26 is used for elevated containers, cards, and interactive surfaces to create subtle depth without breaking the dark immersion.
- **Neutrals:** Desaturated slates are used for secondary text to keep the focus on the content and primary actions.

## Typography
This design system utilizes **Geist** exclusively. Its monolinear, technical structure reinforces the "Tech" half of the Brand & Style, providing exceptional legibility in dark environments. 

Headlines use tighter letter spacing and heavier weights to feel authoritative. Body text maintains a generous line height to ensure long-form reading comfort against the deep background. A dedicated `label-md` style is provided for metadata and small UI descriptors, utilizing uppercase styling and increased tracking for a systematic, "instrument-panel" feel.

## Layout & Spacing
The layout follows a **Fluid Grid** model based on an 8px rhythmic unit. Content is organized within a 12-column system on desktop, collapsing to 4 columns on mobile.

Spacing is used to create "breathing room" that mimics the openness of a forest. Large margins (`margin-desktop`) and significant vertical gaps (`xl`) are encouraged to separate distinct content blocks. Containers should utilize the `md` (24px) padding as a default to ensure internal elements are clearly grouped but not cramped.

## Elevation & Depth
In the "Midnight Forest" environment, depth is communicated through **Tonal Layers** rather than heavy shadows. 

1.  **Base Layer:** The darkest surface (#06100d).
2.  **Raised Layer:** Containers and cards use `surface-bright` (#1a2e26) with a subtle, 1px emerald-tinted border (at 10% opacity) to define edges.
3.  **Interaction Layer:** Hover states utilize a very soft, diffused ambient glow in the primary emerald color (0% - 10% opacity) to simulate a bioluminescent effect.

Avoid traditional drop shadows; instead, use light and color-tinted strokes to indicate hierarchy.

## Shapes
The shape language is **Rounded**, balancing the technicality of the typeface with organic softness. 

- Default elements (Buttons, Inputs) use a 0.5rem (8px) radius.
- Large containers (Cards, Modals) use a 1rem (16px) radius.
- Interactive chips or tags may use 1.5rem (24px) for a more pill-like, approachable appearance.

This consistency in rounding ensures the UI feels tactile and modern, avoiding the harshness of sharp corners.

## Components

- **Buttons:** Primary buttons are solid Emerald (#10b981) with dark text for maximum contrast. Secondary buttons use a `surface-bright` background with an emerald border.
- **Input Fields:** Fields utilize the base surface color but feature an active state border in Emerald. The cursor and selection highlight should always use the primary color.
- **Cards:** Cards use the `surface-bright` color. They should not have shadows; instead, they are distinguished from the background by their tonal shift and the 0.5rem corner radius.
- **Chips:** Small, pill-shaped indicators used for tagging. They should use `tertiary` greens for background with primary emerald text.
- **Lists:** List items are separated by subtle horizontal rules in a muted green-slate. Hover states should gently brighten the background to #1f3a30.
- **Navigation:** Top or side navigation should be semi-transparent with a backdrop blur (glassmorphism) to allow the "forest" background colors to peek through as the user scrolls.