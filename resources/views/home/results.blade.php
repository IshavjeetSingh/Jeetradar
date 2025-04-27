<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Recommendations - RoamRadar</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600|inter:400,500,600,700" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f6f8ff 0%, #f0f3ff 100%);
            color: #333;
            overflow-x: hidden;
        }

        .nav-container {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .nav-container.scrolled {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .gradient-text {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-weight: bold;
        }

        .results-header {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            padding: 120px 0 60px;
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .results-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            animation: float 20s linear infinite;
        }

        .summary-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(99, 102, 241, 0.1);
            position: relative;
            overflow: hidden;
            margin-top: -40px;
            z-index: 10;
        }

        .summary-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .summary-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .summary-card:hover::before {
            opacity: 1;
        }

        .destination-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(99, 102, 241, 0.1);
            overflow: hidden;
            height: 100%;
            position: relative;
        }

        .destination-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .destination-image {
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .destination-card:hover .destination-image {
            transform: scale(1.05);
        }

        .destination-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 200px;
            background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: flex-end;
            padding: 1rem;
        }

        .destination-card:hover .destination-overlay {
            opacity: 1;
        }

        .destination-title {
            color: white;
            font-size: 1.5rem;
            font-weight: 600;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .tag-badge {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.875rem;
            margin: 0.25rem;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .tag-badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(99, 102, 241, 0.2);
        }

        .action-button {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            position: relative;
            overflow: hidden;
        }

        .action-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 100%);
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .action-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(99, 102, 241, 0.3);
        }

        .action-button:hover::before {
            transform: translateX(100%);
        }

        .action-button i {
            font-size: 1.25rem;
        }

        .email-input {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            width: 100%;
            transition: all 0.3s ease;
        }

        .email-input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            outline: none;
        }

        .floating-element {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .delay-1 { animation-delay: 0.2s; }
        .delay-2 { animation-delay: 0.4s; }
        .delay-3 { animation-delay: 0.6s; }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .success-message {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 1rem;
            border-radius: 8px;
            margin-top: 1rem;
            animation: slideIn 0.5s ease-out forwards;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.3s ease;
        }

        .success-message.show {
            opacity: 1;
            transform: translateX(0);
        }

        .success-message.hide {
            opacity: 0;
            transform: translateX(100%);
        }

        .error-message {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            padding: 1rem;
            border-radius: 8px;
            margin-top: 1rem;
            animation: slideIn 0.5s ease-out forwards;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.3s ease;
        }

        .error-message.show {
            opacity: 1;
            transform: translateX(0);
        }

        .error-message.hide {
            opacity: 0;
            transform: translateX(100%);
        }

        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes slideOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }

        .cost-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255, 255, 255, 0.9);
            color: #6366f1;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }

        .action-section {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .action-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #6366f1, #8b5cf6, #6366f1);
            background-size: 200% 100%;
            animation: gradientMove 3s linear infinite;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .section-title i {
            font-size: 1.5rem;
            color: #6366f1;
        }

        .destination-stats {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #e2e8f0;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #6366f1;
        }

        .stat-item i {
            font-size: 1rem;
        }

        .loading-spinner {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .destination-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        .no-results {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .no-results i {
            font-size: 4rem;
            color: #e2e8f0;
            margin-bottom: 1rem;
        }

        .mobile-menu-button {
            display: none;
        }

        @media (max-width: 768px) {
            .mobile-menu-button {
                display: block;
            }

            .nav-links {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                background: white;
                padding: 1rem;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .nav-links.active {
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="nav-container fixed w-full z-50 px-6 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="/" class="text-2xl gradient-text">RoamRadar</a>
            <div class="flex items-center gap-4">
                <div class="nav-links hidden md:flex gap-4">
                    <a href="/recommend" class="text-indigo-600 hover:text-indigo-700 transition-colors">Modify Search</a>
                    <a href="/" class="text-indigo-600 hover:text-indigo-700 transition-colors">Home</a>
                </div>
                <button class="mobile-menu-button md:hidden text-indigo-600">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Results Header -->
    <div class="results-header">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-4xl font-bold mb-4">Your Travel Recommendations</h1>
            <p class="text-xl opacity-90">Based on your preferences, we've found the perfect destinations for you</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-12">
        <!-- Summary Card -->
        <div class="summary-card p-6 mb-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-4">
                    <h3 class="text-xl font-semibold gradient-text">Budget</h3>
                    <p class="text-2xl font-bold">${{ number_format($budget, 2) }}</p>
                </div>
                <div class="space-y-4">
                    <h3 class="text-xl font-semibold gradient-text">Travel Dates</h3>
                    <p class="text-lg">{{ date('F j, Y', strtotime($startDate)) }} - {{ date('F j, Y', strtotime($endDate)) }}</p>
                            </div>
                <div class="space-y-4">
                    <h3 class="text-xl font-semibold gradient-text">Selected Activities</h3>
                    <div class="flex flex-wrap gap-2">
                                    @foreach($activities as $activity)
                            <span class="tag-badge">{{ ucfirst($activity) }}</span>
                                    @endforeach
                    </div>
                                </div>
                            </div>
                        </div>
                        
        <!-- Action Section -->
        <div class="action-section mb-12">
            <div class="section-title">
                <i class="fas fa-share-alt"></i>
                <h2 class="text-xl font-semibold">Share Your Recommendations</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <form id="pdfForm" action="{{ route('recommend.pdf') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <input type="hidden" name="budget" value="{{ $budget }}">
                                    <input type="hidden" name="start_date" value="{{ $startDate }}">
                                    <input type="hidden" name="end_date" value="{{ $endDate }}">
                                    @foreach($activities as $activity)
                                        <input type="hidden" name="activities[]" value="{{ $activity }}">
                                    @endforeach
                    <button type="submit" class="action-button w-full">
                        <i class="fas fa-file-pdf"></i>
                        Download PDF
                                    </button>
                                </form>
                <form id="emailForm" action="{{ route('recommend.email') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <input type="hidden" name="budget" value="{{ $budget }}">
                                    <input type="hidden" name="start_date" value="{{ $startDate }}">
                                    <input type="hidden" name="end_date" value="{{ $endDate }}">
                                    @foreach($activities as $activity)
                                        <input type="hidden" name="activities[]" value="{{ $activity }}">
                                    @endforeach
                    <div class="flex gap-4">
                        <input type="email" name="email" class="email-input" placeholder="Enter your email" required>
                        <button type="submit" class="action-button whitespace-nowrap">
                            <i class="fas fa-paper-plane"></i>
                            Send to Email
                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
        <div id="emailMessage" class="hidden"></div>
                        
                        @if(session('success'))
            <div class="success-message">
                <i class="fas fa-check-circle"></i>
                                {{ session('success') }}
                            </div>
                        @endif
                
        <!-- Destinations Grid -->
                @if(count($destinations) > 0)
            <div class="destination-grid">
                        @foreach($destinations as $destination)
                    <div class="destination-card floating-element delay-{{ $loop->iteration }}">
                        <div class="cost-badge">
                            <i class="fas fa-dollar-sign mr-1"></i>
                            {{ number_format($destination['cost'], 0) }}
                        </div>
                        <img src="{{ $destination['image'] }}" class="destination-image w-full" alt="{{ $destination['name'] }}">
                        <div class="destination-overlay">
                            <h3 class="destination-title">{{ $destination['name'] }}</h3>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 mb-4">{{ $destination['description'] }}</p>
                            <div class="flex flex-wrap gap-2 mb-4">
                                            @foreach($destination['tags'] as $tag)
                                    <span class="tag-badge">{{ ucfirst($tag) }}</span>
                                            @endforeach
                                        </div>
                            <div class="destination-stats">
                                <div class="stat-item">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>7 days</span>
                                    </div>
                                <div class="stat-item">
                                    <i class="fas fa-star"></i>
                                    <span>4.8/5</span>
                                </div>
                            </div>
                    </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-results">
                <i class="fas fa-search"></i>
                <h3 class="text-xl font-semibold mb-2">No destinations found</h3>
                <p class="text-gray-600">We couldn't find any destinations matching your criteria. Try adjusting your budget or selecting different activities.</p>
                <a href="/recommend" class="action-button inline-block mt-4">
                    <i class="fas fa-redo"></i>
                    Modify Search
                </a>
        </div>
        @endif
    </div>

    <script>
        // Mobile menu toggle
        document.querySelector('.mobile-menu-button').addEventListener('click', function() {
            document.querySelector('.nav-links').classList.toggle('active');
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('.nav-container');
            if (window.scrollY > 50) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });

        // Intersection Observer for fade-in animations
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.destination-card').forEach(el => {
            observer.observe(el);
        });

        // Toast message function
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `${type}-message`;
            toast.innerHTML = `<i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>${message}`;
            document.body.appendChild(toast);

            // Show toast
            setTimeout(() => {
                toast.classList.add('show');
            }, 100);

            // Hide and remove toast after 3 seconds
            setTimeout(() => {
                toast.classList.add('hide');
                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 300);
            }, 3000);
        }

        // Email form submission
        document.getElementById('emailForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const form = this;
            const submitButton = form.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.innerHTML;
            
            // Disable button and show loading state
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner loading-spinner"></i> Sending...';
            
            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                showToast(data.message);
                form.reset();
            })
            .catch(error => {
                showToast('An error occurred. Please try again.', 'error');
            })
            .finally(() => {
                submitButton.disabled = false;
                submitButton.innerHTML = originalButtonText;
            });
        });

        // PDF form submission
        document.getElementById('pdfForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const form = this;
            const submitButton = form.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.innerHTML;
            
            // Disable button and show loading state
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner loading-spinner"></i> Generating PDF...';
            
            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.blob())
            .then(blob => {
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'travel-recommendations.pdf';
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
                document.body.removeChild(a);
                showToast('PDF downloaded successfully!');
            })
            .catch(error => {
                showToast('An error occurred while generating PDF. Please try again.', 'error');
            })
            .finally(() => {
                submitButton.disabled = false;
                submitButton.innerHTML = originalButtonText;
            });
        });

        // Add hover effect to destination cards
        document.querySelectorAll('.destination-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>