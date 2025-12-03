@extends('layout')

@section('main')
    <!-- Hero Section -->
    <section class="hero">
        <h1>How Crypt Talk Works</h1>
        <p>Understanding the technology that makes your conversations truly private and secure</p>
    </section>

    <!-- Main Content -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">The Power of AES-256 Encryption</h2>
            <p class="section-subtitle">We use the strongest commercially available encryption standard — the same technology trusted by governments and militaries worldwide.</p>

            <div class="highlight-box">
                <h3>🛡️ Military-Grade Protection</h3>
                <p>Crypt Talk uses <strong>AES-256 encryption</strong> — the gold standard in data security. This is the same encryption used by the U.S. military to protect classified information. With a strong password, it would take a supercomputer approximately <strong>13.8 billion years</strong> to try every possible combination. That's longer than the current age of the universe!</p>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">256-bit</div>
                    <div class="stat-label">Encryption Key Length</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">2²⁵⁶</div>
                    <div class="stat-label">Possible Key Combinations</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">∞</div>
                    <div class="stat-label">Known Successful Attacks</div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Flow -->
    <section class="section section-alt" id="technology">
        <div class="container">
            <h2 class="section-title">The Complete Journey of Your Message</h2>
            <p class="section-subtitle">From your device to your friend's screen — here's what happens behind the scenes</p>

            <div class="flow-container">
                <!-- Step 1 -->
                <div class="flow-step">
                    <div class="flow-content">
                        <div class="step-number">1</div>
                        <h3>Choose Your Secret Password</h3>
                        <p>Before you start chatting, you and your conversation partner agree on a <strong>shared encryption password</strong>. This is your secret key — think of it as a special code that only you two know.</p>
                        <p>This password <strong>never travels over the internet</strong>. You exchange it in person, over the phone, or through another secure channel. No one else can intercept it.</p>
                    </div>
                    <div class="flow-visual">
                        <div class="flow-visual-icon">🔑</div>
                        <h3>Secret Password</h3>
                        <p>Exchanged offline between participants</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="flow-step">
                    <div class="flow-content">
                        <div class="step-number">2</div>
                        <h3>Enter Password in App</h3>
                        <p>Both you and your friend enter the <strong>same password</strong> in your Crypt Talk apps. This password is stored only on your device and is used to encrypt and decrypt messages.</p>
                        <p><strong>Important:</strong> The password never leaves your device. It's not sent to our servers, not stored in the cloud, and not transmitted over any network.</p>
                    </div>
                    <div class="flow-visual">
                        <div class="flow-visual-icon">📱</div>
                        <h3>Local Storage</h3>
                        <p>Password stays on your device only</p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="flow-step">
                    <div class="flow-content">
                        <div class="step-number">3</div>
                        <h3>Type Your Message</h3>
                        <p>You write your message naturally, just like any other messaging app. But before it leaves your device, something magical happens...</p>
                        <p>Your message is instantly transformed using the AES-256 algorithm and your shared password into completely unreadable text.</p>
                    </div>
                    <div class="flow-visual">
                        <div class="flow-visual-icon">✍️</div>
                        <h3>Plain Text</h3>
                        <p>"Hey! Let's meet at 5pm"</p>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="flow-step">
                    <div class="flow-content">
                        <div class="step-number">4</div>
                        <h3>Encryption Happens Instantly</h3>
                        <p>The moment you hit send, your message is encrypted <strong>directly in your browser</strong> using your secret password. It transforms into seemingly random characters that make absolutely no sense to anyone.</p>
                        <p>This all happens in <strong>milliseconds</strong> — so fast you won't even notice!</p>
                    </div>
                    <div class="flow-visual">
                        <div class="flow-visual-icon">🔒</div>
                        <h3>Encrypted Text</h3>
                        <p>"X7k9mP2qL5..."</p>
                    </div>
                </div>

                <!-- Step 5 -->
                <div class="flow-step">
                    <div class="flow-content">
                        <div class="step-number">5</div>
                        <h3>Safe Journey Through the Internet</h3>
                        <p>The encrypted message travels through our servers and the internet, but it's completely unreadable. Even if someone intercepts it, all they see is gibberish.</p>
                        <p><strong>Our servers can't decrypt it. Hackers can't decrypt it. Government agencies can't decrypt it.</strong> Without your password, it's just meaningless random text.</p>
                    </div>
                    <div class="flow-visual">
                        <div class="flow-visual-icon">🌐</div>
                        <h3>Network Transit</h3>
                        <p>Encrypted data travels safely</p>
                    </div>
                </div>

                <!-- Step 6 -->
                <div class="flow-step">
                    <div class="flow-content">
                        <div class="step-number">6</div>
                        <h3>Your Friend Receives It</h3>
                        <p>The encrypted message arrives on your friend's device. Because they have the <strong>same password</strong> you both agreed on, their app can decrypt the message.</p>
                        <p>The decryption happens instantly and automatically on their device. They see your original message, clear and readable!</p>
                    </div>
                    <div class="flow-visual">
                        <div class="flow-visual-icon">🔓</div>
                        <h3>Decrypted Text</h3>
                        <p>"Hey! Let's meet at 5pm"</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Security Deep Dive -->
    <section class="section" id="security">
        <div class="container">
            <h2 class="section-title">Why This Approach is Unbreakable</h2>
            
            <div class="highlight-box highlight-box-blue">
                <h3>⏰ Time to Break Your Encryption</h3>
                <p>With a strong 16-character password containing letters, numbers, and symbols, even the world's most powerful supercomputer would need approximately <strong>13.8 billion years</strong> to try every possible combination. For context, the universe is only about 13.8 billion years old!</p>
            </div>

            <div class="tech-grid">
                <div class="tech-card">
                    <h4>🚫 Zero Knowledge Architecture</h4>
                    <ul>
                        <li>We never see your passwords</li>
                        <li>We can't decrypt your messages</li>
                        <li>We don't store encryption keys</li>
                        <li>Even our administrators can't access your data</li>
                    </ul>
                </div>

                <div class="tech-card">
                    <h4>🔐 Client-Side Encryption</h4>
                    <ul>
                        <li>Encryption happens on your device</li>
                        <li>Decryption happens on recipient's device</li>
                        <li>Plain text never touches our servers</li>
                        <li>Password never leaves your device</li>
                    </ul>
                </div>

                <div class="tech-card">
                    <h4>🛡️ Military-Grade Standard</h4>
                    <ul>
                        <li>AES-256 encryption algorithm</li>
                        <li>Trusted by governments worldwide</li>
                        <li>No known vulnerabilities</li>
                        <li>Future-proof against quantum computers</li>
                    </ul>
                </div>
            </div>

            <div class="info-box">
                <h4>💡 The Password is Everything</h4>
                <p>Your encryption is only as strong as your password. Without stealing your password, there is <strong>no mathematical way</strong> to decrypt your messages. This is why we recommend using long, complex passwords and sharing them only through secure offline channels. Make it memorable for you, but impossible to guess for anyone else!</p>
            </div>
        </div>
    </section>

    <!-- Comparison -->
    <section class="section section-alt" id="comparison">
        <div class="container">
            <h2 class="section-title">Crypt Talk vs Traditional Messaging</h2>
            <p class="section-subtitle">See the difference between typical messaging apps and true end-to-end encryption</p>

            <div class="comparison">
                <div class="comparison-card comparison-bad">
                    <div class="comparison-icon">⚠️</div>
                    <h4>Traditional Messaging Apps</h4>
                    <p><strong>Encryption keys stored on company servers</strong></p>
                    <p>The company can decrypt your messages. Government requests can expose your data. Hackers who breach servers get access to everything. Your privacy depends on trusting the company.</p>
                </div>

                <div class="comparison-card comparison-good">
                    <div class="comparison-icon">✅</div>
                    <h4>Crypt Talk</h4>
                    <p><strong>Password never leaves your device</strong></p>
                    <p>Only you and your conversation partner can decrypt messages. No company access. No government backdoors. No server breaches matter. Your privacy is mathematically guaranteed.</p>
                </div>
            </div>

            <div class="highlight-box">
                <h3>🎯 The Only Way to Read Your Messages</h3>
                <p>There is exactly <strong>ONE way</strong> to read your encrypted messages: knowing the password. Not hacking our servers. Not court orders. Not advanced AI. Not even quantum computers (with proper password length). Just the password. This is the beauty of true end-to-end encryption.</p>
            </div>
        </div>
    </section>

    <!-- Real-World Scenarios -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Real-World Security Scenarios</h2>
            
            <div class="tech-grid">
                <div class="tech-card">
                    <h4>🏢 If Our Servers Are Hacked</h4>
                    <p>Hackers would only get encrypted gibberish. Without your password, the data is completely useless to them. Your conversations remain private.</p>
                </div>

                <div class="tech-card">
                    <h4>👮 If Law Enforcement Requests Data</h4>
                    <p>We can only provide encrypted data that we cannot decrypt ourselves. Your messages remain unreadable without your password.</p>
                </div>

                <div class="tech-card">
                    <h4>📡 If Someone Intercepts Network Traffic</h4>
                    <p>They'll capture encrypted data that cannot be decrypted. It would take billions of years to break the encryption.</p>
                </div>

                <div class="tech-card">
                    <h4>💻 If You Lose Your Device</h4>
                    <p>Your password is stored locally on your device. If you lose it, simply enter the same password on a new device and continue your conversations.</p>
                </div>

                <div class="tech-card">
                    <h4>🔄 If We Go Out of Business</h4>
                    <p>Your messages are stored encrypted. You could export them and decrypt them independently using your password and the AES-256 algorithm.</p>
                </div>

                <div class="tech-card">
                    <h4>🤝 If You Need to Add Someone New</h4>
                    <p>Simply share the conversation password with the new participant through a secure offline channel, and they can join the encrypted conversation.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2>Experience True Privacy Today</h2>
            <p>Join thousands of users who trust Crypt Talk for their most private conversations</p>
            <a href="https://web.crypt-talk.online/" class="btn">Start Messaging Securely</a>
        </div>
    </section>
@endsection