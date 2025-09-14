<?php
/*
Template Name: Business Homepage
Description: Custom full-width homepage for business websites with hero, services, business types, and waitlist form.
*/
get_header();

// Handle Waitlist Form Submission
if ( isset( $_POST['waitlist_submit'] ) && check_admin_referer( 'waitlist_nonce_action', 'waitlist_nonce' ) ) {
    $name = sanitize_text_field( $_POST['name'] );
    $email = sanitize_email( $_POST['email'] );
    $interest = sanitize_text_field( $_POST['service_interest'] );

    // Basic validation
    $errors = array();
    if ( empty( $name ) ) $errors[] = 'Name is required.';
    if ( ! is_email( $email ) ) $errors[] = 'Valid email is required.';

    if ( empty( $errors ) ) {
        // Save as Custom Post Type
        $post_id = wp_insert_post( array(
            'post_title'   => $name . ' - Waitlist Entry',
            'post_content' => 'Email: ' . $email . "\nService Interest: " . $interest,
            'post_status'  => 'publish',
            'post_type'    => 'waitlist_entry',
        ) );

        if ( ! is_wp_error( $post_id ) ) {
            // Optional: Send email notification to admin
            // wp_mail( get_option('admin_email'), 'New Waitlist Entry', 'Name: ' . $name . "\nEmail: " . $email . "\nInterest: " . $interest );

            echo '<div class="waitlist-success">Thank you for joining the waitlist!</div>';
        } else {
            echo '<div class="waitlist-error">Error saving entry. Please try again.</div>';
        }
    } else {
        echo '<div class="waitlist-error">' . implode( '<br>', $errors ) . '</div>';
    }
}
?>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap');
:root{
  --green: #0B3E35;
  --orange: #E16A40;
  --navy: #263586;
  --maxWidth: 1300px;
}
* { box-sizing: border-box; }
body { font-family: 'Poppins', system-ui, Arial, sans-serif; margin:0; }
body { overflow-x: hidden; }

/* Override theme parent container to force vertical stacking and full width */
.site-content, .content-area, .site-main, #primary, #main, .entry-content, article, main {
  display: block !important;
  flex-direction: column !important;
  flex-wrap: nowrap !important;
  width: 100% !important;
  max-width: none !important;
  padding: 0 !important;
  margin: 0 auto !important;
  float: none !important;
  clear: both !important;
}

/* Ensure proper section flow */
section {
  display: block;
  clear: both;
  position: relative;
  width: 100%;
  float: none;
}

/* Force sections to break out of any container constraints */
.solutions-showcase,
.business-types {
  float: none !important;
  position: static !important;
  left: auto !important;
  right: auto !important;
  transform: none !important;
}

/* Header - fixed, transparent by default */
.agate-header {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 1200;
  padding: 18px 24px;
  display:flex;
  align-items:center;
  justify-content: center;
  transition: background-color .28s ease, box-shadow .28s ease;
  background: transparent;
}
.agate-header .header-inner{
  width:100%;
  max-width: var(--maxWidth);
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:16px;
}
.agate-header .logo img { height:46px; width:auto; display:block; }
.custom-nav { display:flex; align-items:center; gap:32px; margin-left:auto; }
.custom-nav a { color:#fff; text-decoration:none; font-weight:600; padding:8px 10px; border-radius:8px; transition:background .2s ease,color .2s ease; }
.custom-nav a.header-cta {
  background: var(--green);
  color:#fff;
  border-radius:26px;
  padding:10px 20px;
  font-weight:700;
  text-decoration:none;
  border: 2px solid transparent;
  margin-left:12px;
}
.custom-nav a:hover, .custom-nav a.header-cta:hover { background:#E16A40; color:#fff; border-color:transparent; }
.agate-header.solid { background:#fff; box-shadow:0 8px 30px rgba(15,15,15,0.06); }
.agate-header.solid .custom-nav a { color: var(--green); }
.agate-header.solid .custom-nav a.header-cta { background: var(--green); color:#fff; border-color:transparent; }

/* Mobile nav */
.hamburger {
  display:none;
  width:36px;
  height:28px;
  background:none;
  border:none;
  padding:0;
  margin-left:auto;
  cursor:pointer;
}
.hamburger span{
  display:block;
  height:3px;
  background:#000;
  margin:6px 0;
  border-radius:3px;
  transition:transform .2s ease, opacity .2s ease;
}
.agate-header:not(.solid) .hamburger span{ background:#000; }
.mobile-menu{
  position:fixed;
  top:70px;
  right:16px;
  left:16px;
  background:#fff;
  border-radius:12px;
  box-shadow:0 18px 50px rgba(0,0,0,0.18);
  padding:18px;
  display:none;
  flex-direction:column;
  gap:12px;
  z-index:1400;
}
.mobile-menu a{
  color:#0B3E35;
  text-decoration:none;
  font-weight:700;
  padding:12px 10px;
  border-radius:8px;
}
.mobile-menu a:hover{ background:#E16A40; color:#fff; }
.mobile-menu .mobile-cta{
  display:block;
  text-align:center;
  background:#0B3E35;
  color:#fff;
  border-radius:26px;
  padding:12px 18px;
  margin-top:8px;
}

/* HERO - full-bleed background */
.hero-section{
  position: relative;
  width:100vw;
  margin-left: calc(50% - 50vw);
  margin-right: calc(50% - 50vw);
  height:100vh;
  min-height:640px;
  overflow:hidden;
  background-image: url('https://example.com/path-to-your-background.jpg'); /* Replace with your image */
  background-size: 160% auto;
  background-position: center right;
  background-repeat:no-repeat;
  display: block;
  clear: both;
}
.hero-section::before{
  content:"";
  position:absolute;
  inset:0;
  background: linear-gradient(90deg, rgba(0,0,0,0.78) 0%, rgba(0,0,0,0.45) 45%, rgba(0,0,0,0) 85%);
  z-index:1;
  pointer-events:none;
}
.hero-inner {
  position:relative;
  width:100%;
  height:100%;
  display:flex;
  align-items:center;
  justify-content:flex-start;
  z-index:2;
}
.hero-content {
  position:relative;
  z-index:2;
  left:6%;
  max-width:620px;
  color:#fff;
  padding: 24px 12px;
  display:flex;
  flex-direction:column;
  justify-content:center;
}
.hero-content h1{
  margin:0 0 18px 0;
  font-size: clamp(2.8rem, 6.6vw, 5.2rem);
  line-height:0.96;
  font-weight:800;
  letter-spacing:-1px;
  color: #fff;
  text-transform: uppercase;
}
.hero-content p{
  margin:0 0 24px 0;
  font-size: clamp(1rem, 1.8vw, 1.2rem);
  color: rgba(255,255,255,0.95);
}
.hero-cta{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  background: var(--green);
  color:#fff;
  padding:12px 24px;
  border-radius:40px;
  font-weight:700;
  text-decoration:none;
  box-shadow: 0 10px 30px rgba(0,0,0,0.25);
  width:auto;
  max-width: 240px;
}
.hero-cta:hover{ background:#E16A40; color:#fff; }
.hero-globe{
  position: absolute;
  right: -6%;
  top: 50%;
  transform: translateY(-50%);
  z-index:2;
  width: clamp(560px, 62vw, 1040px);
  pointer-events:none;
}
.hero-globe img{ width:100%; height:auto; display:block; }

/* Solutions section - sits AFTER hero */
.solutions-showcase {
  background: #f8f9fa;
  padding: 100px 20px;
  position: relative;
  overflow: hidden;
  margin-top: 0;
  clear: both;
  width: 100vw;
  margin-left: calc(50% - 50vw);
  margin-right: calc(50% - 50vw);
  display: block;
}

.solutions-showcase-container {
  max-width: var(--maxWidth);
  margin: 0 auto;
  padding: 0 24px;
}

.solutions-showcase-header {
  text-align: center;
  margin-bottom: 60px;
}

.solutions-showcase-header h2 {
  font-size: clamp(2.2rem, 4vw, 3.5rem);
  color: var(--green);
  margin-bottom: 20px;
  font-weight: 700;
  line-height: 1.2;
}

.solutions-showcase-header p {
  font-size: clamp(1rem, 1.8vw, 1.3rem);
  color: #666;
  max-width: 800px;
  margin: 0 auto;
  line-height: 1.6;
}

/* Desktop Grid */
.solutions-showcase-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
  gap: 30px;
  margin-top: 50px;
}

.solution-showcase-card {
  background: white;
  border-radius: 16px;
  padding: 30px;
  box-shadow: 0 8px 32px rgba(0,0,0,0.08);
  transition: all 0.3s ease;
  border: 1px solid rgba(0,0,0,0.05);
  position: relative;
  overflow: hidden;
}

.solution-showcase-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 20px 40px rgba(0,0,0,0.12);
}

.solution-card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 15px;
}

.solution-card-header h3 {
  font-size: 1.4rem;
  color: var(--green);
  font-weight: 700;
  margin: 0;
}

.solution-arrow {
  color: var(--orange);
  font-size: 1.2rem;
  font-weight: bold;
  transition: transform 0.3s ease;
}

.solution-showcase-card:hover .solution-arrow {
  transform: translateX(5px);
}

.solution-showcase-card p {
  color: #666;
  line-height: 1.6;
  margin-bottom: 25px;
  font-size: 0.95rem;
}

.solution-demo {
  background: #f8f9fa;
  border-radius: 12px;
  padding: 20px;
  border: 1px solid #e9ecef;
}

/* Currency Display (example for services) */
.currency-display {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.currency-item {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px;
  background: white;
  border-radius: 8px;
  border: 1px solid #e9ecef;
}

.currency-flag {
  font-size: 1.2rem;
}

.currency-amount {
  font-weight: 700;
  color: var(--green);
  font-size: 1.1rem;
}

.currency-code {
  color: #666;
  font-size: 0.9rem;
  margin-left: auto;
}

/* Add similar styles for other demo blocks as in previous code... (truncated for brevity, copy from earlier if needed) */

/* Waitlist Form Styles */
.waitlist-section {
    background: #f8f9fa;
    padding: 80px 20px;
    text-align: center;
}
.waitlist-container {
    max-width: 500px;
    margin: 0 auto;
    background: white;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}
.waitlist-form label {
    display: block;
    text-align: left;
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
}
.waitlist-form input[type="text"],
.waitlist-form input[type="email"],
.waitlist-form select {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 1rem;
}
.waitlist-form input[type="submit"] {
    background: #007bff;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 4px;
    cursor: pointer;
    font-weight: 700;
}
.waitlist-form input[type="submit"]:hover {
    background: #0056b3;
}
.waitlist-success, .waitlist-error {
    padding: 12px;
    margin-bottom: 20px;
    border-radius: 4px;
}
.waitlist-success { background: #d4edda; color: #155724; }
.waitlist-error { background: #f8d7da; color: #721c24; }

/* Responsive styles (copy from earlier code) */
</style>
<header class="agate-header" role="banner">
  <div class="header-inner">
    <div class="logo">
      <a href="<?php echo esc_url(home_url('/')); ?>">
        <img src="https://example.com/path-to-your-logo.png" alt="<?php echo esc_attr(get_bloginfo('name')); ?>"> /* Replace with your logo */
      </a>
    </div>
    <nav class="custom-nav" role="navigation" aria-label="Primary">
      <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
      <a href="<?php echo esc_url(home_url('/services/')); ?>">Services</a>
      <a href="<?php echo esc_url(home_url('/about/')); ?>">About</a>
      <a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a>
      <a class="header-cta" href="#contact">Join Waitlist</a>
    </nav>
  </div>
</header>

<!-- HERO SECTION -->
<section class="hero-section" role="region" aria-label="Hero">
  <div class="hero-inner">
    <div class="hero-content">
      <h1>YOUR BUSINESS TAGLINE HERE</h1>
      <p>Empowering your business with innovative solutions.</p>
      <a href="#contact" class="hero-cta">Get Started</a>
    </div>
    <div class="hero-globe" aria-hidden="true">
      <img src="https://example.com/path-to-your-globe.png" alt=""> /* Replace with your image */
    </div>
  </div>
</section>

<!-- SERVICES SHOWCASE (Solutions) -->
<section class="solutions-showcase" role="region" aria-label="Services">
  <!-- Copy the full HTML from earlier code for this section -->
  <!-- For brevity, assuming it's the same as previous, with 4 cards for services like Foreign Exchange, etc. -->
</section>

<!-- BUSINESS TYPES SECTION -->
<section class="business-types" role="region" aria-label="Business Types">
  <!-- Copy the full HTML from earlier code for this section -->
</section>

<!-- WAITLIST FORM SECTION -->
<section class="waitlist-section" id="contact" role="region" aria-label="Join Waitlist">
  <div class="waitlist-container">
    <h2>Join the Waitlist</h2>
    <p>Sign up for updates on our services.</p>
    <form class="waitlist-form" method="post" action="">
      <?php wp_nonce_field( 'waitlist_nonce_action', 'waitlist_nonce' ); ?>
      <label for="name">Name *</label>
      <input type="text" id="name" name="name" placeholder="John Doe" required>
      
      <label for="email">Email *</label>
      <input type="email" id="email" name="email" placeholder="me@mycompany.com" required>
      
      <label for="service_interest">Service Interest</label>
      <select id="service_interest" name="service_interest">
        <option value="Service 1">Service 1</option>
        <option value="Service 2">Service 2</option>
        <option value="Service 3">Service 3</option>
        <option value="Service 4">Service 4</option>
      </select>
      
      <input type="submit" name="waitlist_submit" value="Submit">
    </form>
  </div>
</section>

<script>
  // Copy the full JS from earlier code for header scroll, mobile menu, slider, smooth scroll, parallax
</script>
<?php get_footer(); ?>