<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crypt Talk - Secure Encrypted Messaging</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        /* Navigation */
        nav {
            background: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        nav .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #4A90E2;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #4A90E2;
        }

        .cta-nav {
            background: #4A90E2;
            color: white !important;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 150px 2rem 100px;
            text-align: center;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            font-weight: 700;
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            opacity: 0.95;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 1rem 2.5rem;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s;
            display: inline-block;
        }

        .btn-primary {
            background: white;
            color: #667eea;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .btn-secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-secondary:hover {
            background: white;
            color: #667eea;
        }

        /* Features Section */
        .features {
            padding: 100px 2rem;
            background: #f8f9fa;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .section-subtitle {
            text-align: center;
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 4rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 3rem;
            margin-top: 3rem;
        }

        .feature-card {
            background: white;
            padding: 2.5rem;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: transform 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .feature-icon {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .feature-card p {
            color: #666;
            line-height: 1.8;
        }

        /* How It Works Section */
        .how-it-works {
            padding: 100px 2rem;
            background: white;
        }

        .steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
            margin-top: 4rem;
        }

        .step {
            text-align: center;
            position: relative;
        }

        .step-number {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: bold;
            margin: 0 auto 1.5rem;
        }

        .step h3 {
            font-size: 1.3rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .step p {
            color: #666;
            line-height: 1.8;
        }

        /* Platforms Section */
        .platforms {
            padding: 100px 2rem;
            background: #f8f9fa;
        }

        .platform-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .platform-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .platform-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
        }

        .platform-card h3 {
            font-size: 1.3rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .platform-card .btn {
            margin-top: 1rem;
            padding: 0.7rem 1.5rem;
            font-size: 0.95rem;
        }

        /* Pricing Section */
        .pricing {
            padding: 100px 2rem;
            background: white;
        }

        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 3rem;
            margin-top: 4rem;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
        }

        .pricing-card {
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 20px;
            padding: 3rem 2rem;
            text-align: center;
            transition: all 0.3s;
        }

        .pricing-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .pricing-card.featured {
            border-color: #667eea;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: scale(1.05);
        }

        .pricing-card.featured h3,
        .pricing-card.featured .price,
        .pricing-card.featured li {
            color: white;
        }

        .pricing-card h3 {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .price {
            font-size: 3rem;
            font-weight: bold;
            margin: 1.5rem 0;
            color: #667eea;
        }

        .price span {
            font-size: 1.2rem;
            font-weight: normal;
        }

        .pricing-features {
            list-style: none;
            margin: 2rem 0;
            text-align: left;
        }

        .pricing-features li {
            padding: 0.7rem 0;
            color: #666;
            position: relative;
            padding-left: 2rem;
        }

        .pricing-features li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #4CAF50;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .pricing-card.featured .pricing-features li:before {
            color: white;
        }

        /* Footer */
        footer {
            background: #2c3e50;
            color: white;
            padding: 4rem 2rem 2rem;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-section h3 {
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 0.7rem;
        }

        .footer-section a {
            color: #bdc3c7;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-section a:hover {
            color: white;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid #34495e;
            color: #bdc3c7;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-links a {
            width: 40px;
            height: 40px;
            background: #34495e;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: background 0.3s;
        }

        .social-links a:hover {
            background: #4A90E2;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .nav-links {
                display: none;
            }

            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="container">
            <div class="logo">
                🔐 Crypt Talk
            </div>
            <ul class="nav-links">
                <li><a href="#features">Features</a></li>
                <li><a href="#how-it-works">How It Works</a></li>
                <li><a href="#platforms">Platforms</a></li>
                <li><a href="#pricing">Pricing</a></li>
                <li><a href="#" class="cta-nav">Get Started</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Your Privacy, Our Priority</h1>
        <p>Experience truly secure messaging with end-to-end encryption. No one can read your messages — not even us.</p>
        <div class="hero-buttons">
            <a href="https://web.crypt-talk.online/" class="btn btn-primary">Launch Web App</a>
            <a href="#platforms" class="btn btn-secondary">Download Apps</a>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features">
        <div class="container">
            <h2 class="section-title">Military-Grade Security</h2>
            <p class="section-subtitle">Your conversations deserve the highest level of protection. Here's how we keep your data secure.</p>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <h3>End-to-End Encryption</h3>
                    <p>Every message is encrypted directly in your browser. Only you and the recipient can decrypt and read your messages.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">🔑</div>
                    <h3>Client-Side Encryption</h3>
                    <p>Encryption keys never leave your device. Exchange keys offline for maximum security.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">🚫</div>
                    <h3>Zero Knowledge</h3>
                    <p>We can't read your messages even if we wanted to. Not even system administrators have access to your conversations.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h3>Real-Time Messaging</h3>
                    <p>Enjoy instant, secure communication without compromising on speed or user experience.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">👥</div>
                    <h3>Group Conversations</h3>
                    <p>Create secure group chats with the same level of encryption and privacy protection.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">🌐</div>
                    <h3>Cross-Platform</h3>
                    <p>Seamlessly sync your encrypted conversations across all your devices.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="how-it-works">
        <div class="container">
            <h2 class="section-title">How Encryption Works</h2>
            <p class="section-subtitle">Understanding the technology that keeps your messages private and secure.</p>
            
            <div class="steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <h3>Generate Keys</h3>
                    <p>Each user generates a unique encryption key pair directly in their browser.</p>
                </div>

                <div class="step">
                    <div class="step-number">2</div>
                    <h3>Exchange Keys Offline</h3>
                    <p>Share your encryption key with trusted contacts through a secure, offline channel.</p>
                </div>

                <div class="step">
                    <div class="step-number">3</div>
                    <h3>Encrypt Messages</h3>
                    <p>Your messages are encrypted locally before being sent over the network.</p>
                </div>

                <div class="step">
                    <div class="step-number">4</div>
                    <h3>Secure Delivery</h3>
                    <p>Encrypted messages travel through our servers but remain completely unreadable.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Platforms Section -->
    <section id="platforms" class="platforms">
        <div class="container">
            <h2 class="section-title">Available on All Your Devices</h2>
            <p class="section-subtitle">Secure messaging wherever you are, on any platform you prefer.</p>
            
            <div class="platform-grid">
                <div class="platform-card">
                    <div class="platform-icon">🌐</div>
                    <h3>Web</h3>
                    <p>Access from any browser</p>
                    <a href="https://web.crypt-talk.online/" class="btn btn-primary">Launch App</a>
                </div>

                <div class="platform-card">
                    <div class="platform-icon">🤖</div>
                    <h3>Android</h3>
                    <p>Google Play Store</p>
                    <a href="{{ asset('downloads/app-release-signed.apk') }}" class="btn btn-primary" download>Download APK</a>
                </div>

                <div class="platform-card">
                    <div class="platform-icon">🍎</div>
                    <h3>iOS</h3>
                    <p>App Store</p>
                    <a href="#" class="btn btn-secondary">Coming Soon</a>
                </div>

                <div class="platform-card">
                    <div class="platform-icon">🖥️</div>
                    <h3>Windows</h3>
                    <p>Desktop Application</p>
                    <a href="#" class="btn btn-secondary">Coming Soon</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="pricing">
        <div class="container">
            <h2 class="section-title">Choose Your Plan</h2>
            <p class="section-subtitle">Start with our free plan or unlock premium features for enhanced security.</p>
            
            <div class="pricing-grid">
                <div class="pricing-card">
                    <h3>Free</h3>
                    <div class="price">$0<span>/month</span></div>
                    <ul class="pricing-features">
                        <li>End-to-end encryption</li>
                        <li>Unlimited messages</li>
                        <li>Up to 5 group chats</li>
                        <li>Basic support</li>
                        <li>Web & mobile access</li>
                    </ul>
                    <a href="#" class="btn btn-secondary">Get Started</a>
                </div>

                <div class="pricing-card featured">
                    <h3>Premium</h3>
                    <div class="price">$4.99<span>/month</span></div>
                    <ul class="pricing-features">
                        <li>Everything in Free</li>
                        <li>Unlimited group chats</li>
                        <li>Priority support</li>
                        <li>Advanced security features</li>
                        <li>File sharing up to 100MB</li>
                        <li>Custom encryption keys</li>
                        <li>No ads</li>
                    </ul>
                    <a href="#" class="btn btn-primary">Go Premium</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>🔐 Crypt Talk</h3>
                    <p>The most secure messaging platform for privacy-conscious users.</p>
                    <div class="social-links">
                        <a href="#">📘</a>
                        <a href="#">🐦</a>
                        <a href="#">📷</a>
                        <a href="#">💼</a>
                    </div>
                </div>

                <div class="footer-section">
                    <h3>Product</h3>
                    <ul>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#platforms">Download</a></li>
                        <li><a href="#pricing">Pricing</a></li>
                        <li><a href="#">Documentation</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3>Company</h3>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3>Legal</h3>
                    <ul>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Security</a></li>
                        <li><a href="#">Cookie Policy</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2024 Crypt Talk. All rights reserved. Your privacy is our mission.</p>
            </div>
        </div>
    </footer>
</body>
</html>