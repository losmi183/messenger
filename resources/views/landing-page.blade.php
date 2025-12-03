@extends('layout')

@section('content')
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
@endsection