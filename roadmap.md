# Current Roadmap to v1.0

Timepicker
- [x] Fix Timepicker Error Log
- [x] Create skin for date/time picker
  
Main tasks
- [x] Vertical menu in PostType settings
- [x] Grid markup in post type settings
- [x] Create CSS styles
- [x] Create default values for metaboxes, or write an error output function when there is a lack of input data
  - [x] Make automatic substitution of default values when there is a lack of data from the admin panel
  - [x] **MVP** Fix the die stub in the shortcode output (gl_datetime)
  - [x] Write automatic generation of the end date, if there is no corresponding value in metabox
- [x] Shortcode generation
- [x] Clean the code from comments and output debugging information
- [ ] Write documentation for the plugin

**MVP** Timer Functionallity
- [x] Create Timer layout
- [x] Calculating the remaining time until the scheduled date
- [x] Calculating the time zone from Wordpress settings
  - [x] UTC Format
  - [x] String Format
- [x] Layout
  - [x] Main sections
    - [x] Heading
    - [x] Paragraph
    - [x] Button
  - [x] Timer Sections
    - [x] Numbers
  - [x] Adaptive
    - [x] Tablet
    - [x] Mobile
- [x] Support for multiple timers on one page

Build testing
- [x] Installation
- [x] Deinstalation
- [x] Metaboxes functionallity
- [x] Metaboxes default values
- [x] Shortcodes generation

Other
- [x] Create metaboxes for custom posttype
- [ ] Create class (php, css) hierarchy
- [ ] Think over the hierarchy of files for the layout of the post type settings page

Constantly
- [x] Refactor

For next versions
- [ ] Make language support