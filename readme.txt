=== Divi Project Permalinks ===
Contributors: Miss Web
Requires at least: 6.0
Tested up to: 6.5
Stable tag: 1.6.1
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Configure clean permalinks for Divi Projects by category or custom slug. Export/Import settings and optional 301 redirects included.

== Description ==
Divi Project Permalinks generates single **Project** (`project` post type) URLs based on the project’s **primary** category (Yoast Primary Term supported).  
You can also add rules for **custom slugs** (we’ll auto-create a matching `project_category` term), define a **default base**, and enable **301 redirects** to keep SEO intact when structures change.

**Examples**
* If category is `apartments` → `/real-estate/apartments/%postname%/`
* Otherwise (fallback) → `/projects/%postname%/`

**Highlights**
* Rules per **project category** or **custom slug** (auto-creates category)
* **Default base** fallback (e.g. `projects`)
* Optional **301 redirects** to canonical URLs
* **Export / Import** settings (JSON)
* No inline CSS/JS (assets loaded only on this plugin’s settings page)
* i18n-ready (`Text Domain: dpp`, `languages/dpp.pot`)
* Security first (sanitize/escape, capabilities: `manage_options`)

**Requirements**
* WordPress 6.0+
* PHP 7.4+
* Divi (for the `project` post type and `project_category` taxonomy)

== Installation ==
1. Upload and activate the plugin.
2. Go to **Settings → Project Permalinks** and add rules.
3. Visit **Settings → Permalinks** and click **Save Changes** to flush rewrite rules.

== Frequently Asked Questions ==

= I get 404 on single projects =
Open **Settings → Permalinks** and click **Save Changes**. This flushes rewrite rules.

= Do I need Yoast SEO? =
No. If Yoast is active, the **Primary Term** is used as the project’s primary category. Otherwise, the first assigned term is used.

= What happens when I choose “Custom slug”? =
We automatically create a `project_category` with that slug (if it doesn’t exist) and store the rule as a category-based rule.

= What do 301 redirects do? =
When enabled, single project pages that are accessed via a non-canonical base are **permanently redirected (301)** to the canonical URL generated from your rules.

= Will this affect archive pages? =
This plugin focuses on **single** project URLs. Category archives behave as normal.

== Screenshots ==
1. Settings screen with rules table (Project category / Custom slug → Base path) and Export/Import.

== Changelog ==
= 1.6.1 =
* Added Export/Import (JSON) with nonce and capability checks
* Added optional 301 redirects to canonical URLs
* Added automatic `project_category` creation when using “Custom slug”
* Hardened sanitization/escaping; Settings API polish
* Admin UI spacing/width tweaks; assets enqueued only on settings screen
* i18n updates and `.pot` scaffold

= 1.5.2 =
* Marketplace-ready structure (assets/includes/languages/uninstall)
* Clean admin UI, no inline styles, localized strings
* Settings via WP Settings API

== Upgrade Notice ==
= 1.6.1 =
New: Export/Import + optional 301 redirects + auto-create category from Custom slug. After updating, visit **Settings → Permalinks** and click **Save Changes**.

== Test Steps ==
1. Create project categories, e.g. `apartments`, `houses`.
2. In plugin settings add rules:
   * **Project category** `apartments` → base `real-estate/apartments`
3. Assign a project to `apartments` and open its URL — it should follow the rule.
4. Assign a project to another category (or none) — it should use the **Default base**.
5. Toggle **Enable 301 redirects**, open an old/non-canonical URL — it should redirect to the canonical one.
6. Test **Export** (download JSON), change settings, then **Import** the file — settings should be restored.

== Edge Cases ==
* Multiple categories: Yoast Primary Term is used; otherwise the first assigned term.
* Duplicate base paths are de-duplicated during rule registration.
* Custom slug rules create a matching `project_category` if it doesn’t exist.
* Trailing slashes follow your WordPress permalink settings (canonicalized when redirects are enabled).
