<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>RoamRadar - Your Travel Companion</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600|inter:400,500,600,700" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
        <!-- Add direct styles for immediate visual enhancement -->
        <style>
            body {
                background: linear-gradient(135deg, #f6f8ff 0%, #f0f3ff 100%);
                color: #333;
                overflow-x: hidden;
            }
            
            .nav-container {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                overflow: hidden;
            }

            .nav-container::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, 
                    rgba(99, 102, 241, 0.05) 0%, 
                    rgba(139, 92, 246, 0.05) 25%, 
                    rgba(99, 102, 241, 0.05) 50%, 
                    rgba(139, 92, 246, 0.05) 75%, 
                    rgba(99, 102, 241, 0.05) 100%);
                background-size: 200% 100%;
                animation: gradientShift 8s linear infinite;
                z-index: -1;
            }

            .nav-container.scrolled {
                background: rgba(30, 27, 75, 0.95);
                backdrop-filter: blur(20px);
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .logo-container {
                position: relative;
                display: inline-block;
                padding: 0.5rem 1rem;
                border-radius: 8px;
                overflow: hidden;
                transition: all 0.3s ease;
            }

            .logo-container:hover {
                transform: translateY(-2px);
            }

            .logo-glow {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: radial-gradient(circle at center, rgba(99, 102, 241, 0.3) 0%, transparent 70%);
                opacity: 0;
                transition: opacity 0.3s ease;
                z-index: 1;
            }

            .logo-container:hover .logo-glow {
                opacity: 1;
                animation: pulse 2s infinite;
            }

            .logo-particles {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 0;
            }

            .gradient-text {
                background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
                -webkit-background-clip: text;
                background-clip: text;
                color: transparent;
                font-weight: bold;
                position: relative;
                z-index: 2;
            }

            .nav-toggle {
                display: none;
                flex-direction: column;
                justify-content: space-between;
                width: 30px;
                height: 21px;
                cursor: pointer;
                position: relative;
                z-index: 50;
            }

            .hamburger-line {
                width: 100%;
                height: 3px;
                background: linear-gradient(90deg, #6366f1, #8b5cf6);
                border-radius: 3px;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                transform-origin: left center;
            }

            .nav-toggle:hover .hamburger-line {
                background: linear-gradient(90deg, #8b5cf6, #6366f1);
            }

            .nav-toggle.active .hamburger-line:nth-child(1) {
                transform: rotate(45deg);
            }

            .nav-toggle.active .hamburger-line:nth-child(2) {
                opacity: 0;
            }

            .nav-toggle.active .hamburger-line:nth-child(3) {
                transform: rotate(-45deg);
            }

            .nav-menu {
                display: flex;
                align-items: center;
                gap: 1.5rem;
            }

            .nav-link {
                position: relative;
                color: #4f46e5;
                text-decoration: none;
                padding: 0.5rem 1rem;
                border-radius: 8px;
                transition: all 0.3s ease;
                overflow: hidden;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .nav-link-text {
                position: relative;
                z-index: 2;
                font-weight: 500;
            }

            .nav-link-glow {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: radial-gradient(circle at center, rgba(99, 102, 241, 0.2) 0%, transparent 70%);
                opacity: 0;
                transition: opacity 0.3s ease;
                z-index: 1;
            }

            .nav-link:hover .nav-link-glow {
                opacity: 1;
            }

            .nav-link-icon {
                display: none;
                font-size: 0.875rem;
                transition: transform 0.3s ease;
            }

            .nav-link:hover .nav-link-icon {
                display: inline-block;
                transform: translateX(0);
            }

            .nav-link:hover {
                color: #ffffff;
                transform: translateY(-2px);
            }

            .nav-link:hover .nav-link-icon {
                color: #ffffff;
            }

            .nav-link::before {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 2px;
                background: linear-gradient(90deg, #6366f1, #8b5cf6);
                transform: scaleX(0);
                transform-origin: right;
                transition: transform 0.3s ease;
            }

            .nav-link:hover::before {
                transform: scaleX(1);
                transform-origin: left;
            }

            .register-button {
                background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
                color: white;
                padding: 0.75rem 1.5rem;
                border-radius: 8px;
                font-weight: 600;
                transition: all 0.3s ease;
                text-decoration: none;
                position: relative;
                overflow: hidden;
                z-index: 1;
                display: flex;
                align-items: center;
            }

            .register-button:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 16px rgba(99, 102, 241, 0.3);
                background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            }

            .button-content {
                position: relative;
                z-index: 2;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .button-glow {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: radial-gradient(circle at center, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .register-button:hover .button-glow {
                opacity: 1;
            }

            .button-particles {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 0;
            }

            .register-button:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 16px rgba(99, 102, 241, 0.3);
                background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            }

            @keyframes gradientShift {
                0% {
                    background-position: 0% 50%;
                }
                100% {
                    background-position: 200% 50%;
                }
            }

            @media (max-width: 768px) {
                .nav-toggle {
                    display: flex;
                }

                .nav-menu {
                    position: fixed;
                    top: 70px;
                    left: 0;
                    width: 100%;
                    background: rgba(30, 27, 75, 0.95);
                    backdrop-filter: blur(20px);
                    padding: 1.5rem;
                    flex-direction: column;
                    align-items: flex-start;
                    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
                    transform: translateY(-100%);
                    opacity: 0;
                    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
                    z-index: 50;
                    border-top: 1px solid rgba(255, 255, 255, 0.1);
                }

                .nav-menu.active {
                    transform: translateY(0);
                    opacity: 1;
                }

                .nav-menu a {
                    width: 100%;
                    padding: 1rem;
                    margin: 0.25rem 0;
                    border-radius: 8px;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                }

                .nav-link-icon {
                    display: inline-block;
                    font-size: 1rem;
                }

                .register-button {
                    margin-top: 1rem;
                    justify-content: center;
                }
            }

            .hero-section {
                position: relative;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                overflow: hidden;
                background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%);
            }

            .hero-background {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 1;
                background-image: url('https://images.unsplash.com/photo-1469474968028-56623f02e42e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
            }

            .hero-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, rgba(30, 27, 75, 0.9) 0%, rgba(49, 46, 129, 0.85) 100%);
                z-index: 2;
            }

            .hero-particles {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 3;
            }

            .hero-content {
                position: relative;
                z-index: 10;
                padding: 120px 0;
            }

            .hero-badge {
                display: inline-flex;
                align-items: center;
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border-radius: 50px;
                padding: 0.5rem 1.5rem;
                margin-bottom: 2rem;
                transform: translateY(20px);
                opacity: 0;
                animation: fadeInUp 0.8s ease forwards 0.5s;
            }

            .badge-text {
                color: white;
                font-weight: 500;
                margin-right: 0.75rem;
            }

            .badge-icon {
                width: 24px;
                height: 24px;
                background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 0.75rem;
                animation: pulse 2s infinite;
            }

            .hero-title {
                opacity: 0;
                transform: translateY(20px);
                animation: fadeInUp 0.8s ease forwards 0.7s;
            }

            .hero-title-line {
                display: block;
                line-height: 1.2;
            }

            .hero-title-line.highlight {
                background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
                -webkit-background-clip: text;
                background-clip: text;
                color: transparent;
                position: relative;
            }

            .hero-title-line.highlight::after {
                content: '';
                position: absolute;
                bottom: -5px;
                left: 0;
                width: 100%;
                height: 3px;
                background: linear-gradient(90deg, #6366f1, #8b5cf6);
                transform: scaleX(0);
                transform-origin: left;
                animation: lineGrow 1s ease-out 1.5s forwards;
            }

            .hero-description {
                opacity: 0;
                transform: translateY(20px);
                animation: fadeInUp 0.8s ease forwards 0.9s;
                color: rgba(255, 255, 255, 0.9);
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            }

            .hero-buttons {
                opacity: 0;
                transform: translateY(20px);
                animation: fadeInUp 0.8s ease forwards 1.1s;
            }

            .primary-button {
                background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
                color: white;
                padding: 1rem 2rem;
                border-radius: 8px;
                font-weight: 600;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
                z-index: 1;
            }

            .secondary-button {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                color: white;
                padding: 1rem 2rem;
                border-radius: 8px;
                font-weight: 600;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
                z-index: 1;
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .button-content {
                position: relative;
                z-index: 2;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .primary-button:hover .button-glow,
            .secondary-button:hover .button-glow {
                opacity: 1;
            }

            .primary-button:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
            }

            .secondary-button:hover {
                transform: translateY(-5px);
                background: rgba(255, 255, 255, 0.2);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            }

            .hero-stats {
                opacity: 0;
                transform: translateY(20px);
                animation: fadeInUp 0.8s ease forwards 1.3s;
            }

            .stat-item {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border-radius: 8px;
                padding: 1.5rem;
                text-align: center;
                transition: all 0.3s ease;
            }

            .stat-item:hover {
                transform: translateY(-5px);
                background: rgba(255, 255, 255, 0.15);
            }

            .stat-number {
                font-size: 2.5rem;
                font-weight: 700;
                color: white;
                margin-bottom: 0.5rem;
            }

            .stat-label {
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.875rem;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            }

            .hero-scroll-indicator {
                position: absolute;
                bottom: 2rem;
                left: 50%;
                transform: translateX(-50%);
                display: flex;
                flex-direction: column;
                align-items: center;
                opacity: 0;
                animation: fadeIn 1s ease forwards 1.5s;
            }

            .scroll-text {
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.875rem;
                margin-bottom: 0.5rem;
            }

            .scroll-icon {
                color: white;
                animation: bounce 2s infinite;
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }
                to {
                    opacity: 1;
                }
            }

            @keyframes lineGrow {
                to {
                    transform: scaleX(1);
                }
            }

            @keyframes pulse {
                0% {
                    transform: scale(1);
                    box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.7);
                }
                70% {
                    transform: scale(1.1);
                    box-shadow: 0 0 0 10px rgba(99, 102, 241, 0);
                }
                100% {
                    transform: scale(1);
                    box-shadow: 0 0 0 0 rgba(99, 102, 241, 0);
                }
            }

            @keyframes bounce {
                0%, 20%, 50%, 80%, 100% {
                    transform: translateY(0);
                }
                40% {
                    transform: translateY(-10px);
                }
                60% {
                    transform: translateY(-5px);
                }
            }

            .feature-card {
                background: white;
                border-radius: 16px;
                padding: 2rem;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
                border: 1px solid rgba(99, 102, 241, 0.1);
                position: relative;
                overflow: hidden;
                cursor: pointer;
            }

            .feature-card::before {
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

            .feature-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
                border-color: rgba(99, 102, 241, 0.3);
            }

            .feature-card:hover::before {
                opacity: 1;
            }

            .feature-icon {
                font-size: 2.5rem;
                margin-bottom: 1rem;
                background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
                -webkit-background-clip: text;
                background-clip: text;
                color: transparent;
                transition: transform 0.3s ease;
            }

            .feature-card:hover .feature-icon {
                transform: scale(1.2) rotate(5deg);
            }

            .cta-section {
                background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
                color: white;
                padding: 80px 0;
                position: relative;
                overflow: hidden;
            }

            .cta-section::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-image: 
                    radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                    radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                    url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
                background-size: 100% 100%, 100% 100%, 100px 100px;
                opacity: 0.7;
                animation: ctaBackgroundShift 15s ease-in-out infinite alternate;
                z-index: 1;
            }

            .cta-section::after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, rgba(79, 70, 229, 0.2) 0%, rgba(124, 58, 237, 0.2) 100%);
                z-index: 2;
                pointer-events: none;
            }

            @keyframes ctaBackgroundShift {
                0% {
                    background-position: 0% 0%, 0% 0%, 0 0;
                }
                100% {
                    background-position: 10% 10%, -10% -10%, 50px 50px;
                }
            }

            .cta-button {
                background: white;
                color: #4f46e5;
                padding: 1rem 2rem;
                border-radius: 8px;
                font-weight: 600;
                transition: all 0.3s ease;
                text-decoration: none;
                display: inline-block;
                position: relative;
                overflow: hidden;
                z-index: 3;
            }

            .cta-button::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%);
                z-index: -1;
                transform: scaleX(0);
                transform-origin: right;
                transition: transform 0.3s ease;
            }

            .cta-button:hover::before {
                transform: scaleX(1);
                transform-origin: left;
            }

            .cta-button:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            }

            .footer {
                background: #1e1b4b;
                color: white;
                padding: 60px 0 30px;
                position: relative;
                overflow: hidden;
            }

            .footer::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
                opacity: 0.5;
            }

            .footer-logo {
                font-size: 1.5rem;
                font-weight: bold;
                margin-bottom: 1rem;
                background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
                -webkit-background-clip: text;
                background-clip: text;
                color: transparent;
            }

            .footer-link {
                color: #a5b4fc;
                text-decoration: none;
                transition: all 0.3s ease;
                display: inline-block;
                margin-bottom: 0.5rem;
            }

            .footer-link:hover {
                color: white;
                transform: translateX(5px);
            }

            .social-icon {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 36px;
                height: 36px;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.1);
                color: white;
                margin-right: 0.5rem;
                transition: all 0.3s ease;
            }

            .social-icon:hover {
                background: #6366f1;
                transform: translateY(-3px);
            }

            .copyright {
                border-top: 1px solid rgba(255, 255, 255, 0.1);
                padding-top: 1.5rem;
                margin-top: 2rem;
                text-align: center;
                color: #a5b4fc;
            }

            .logo-container {
                position: relative;
                display: inline-block;
            }

            .logo-container::after {
                content: '';
                position: absolute;
                bottom: -5px;
                left: 0;
                width: 100%;
                height: 2px;
                background: linear-gradient(90deg, #6366f1, #8b5cf6);
                transform: scaleX(0);
                transform-origin: right;
                transition: transform 0.3s ease;
            }

            .logo-container:hover::after {
                transform: scaleX(1);
                transform-origin: left;
            }

            .nav-toggle {
                display: none;
                flex-direction: column;
                justify-content: space-between;
                width: 30px;
                height: 21px;
                cursor: pointer;
            }

            .nav-toggle span {
                display: block;
                height: 3px;
                width: 100%;
                background: #4f46e5;
                border-radius: 3px;
                transition: all 0.3s ease;
            }

            .nav-menu {
                display: flex;
                align-items: center;
            }

            @media (max-width: 768px) {
                .nav-toggle {
                    display: flex;
                }

                .nav-menu {
                    position: fixed;
                    top: 70px;
                    left: 0;
                    width: 100%;
                    background: white;
                    padding: 1rem;
                    flex-direction: column;
                    align-items: flex-start;
                    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
                    transform: translateY(-100%);
                    opacity: 0;
                    transition: all 0.3s ease;
                    z-index: 50;
                }

                .nav-menu.active {
                    transform: translateY(0);
                    opacity: 1;
                }

                .nav-menu a {
                    margin: 0.5rem 0;
                    width: 100%;
                    padding: 0.75rem 0;
                }
            }

            .nav-toggle.active span:nth-child(1) {
                transform: translateY(9px) rotate(45deg);
            }

            .nav-toggle.active span:nth-child(2) {
                opacity: 0;
            }

            .nav-toggle.active span:nth-child(3) {
                transform: translateY(-9px) rotate(-45deg);
            }

            .floating-element {
                animation: float 6s ease-in-out infinite;
            }

            @keyframes float {
                0% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
                100% { transform: translateY(0px); }
            }

            .delay-1 { animation-delay: 0.2s; }
            .delay-2 { animation-delay: 0.4s; }
            .delay-3 { animation-delay: 0.6s; }

            #featureDetails {
                opacity: 0;
                transform: translateY(20px);
                transition: all 0.3s ease;
            }

            #featureDetails.show {
                opacity: 1;
                transform: translateY(0);
            }

            .feature-detail-item {
                display: flex;
                align-items: start;
                gap: 1rem;
                padding: 1rem;
                background: rgba(99, 102, 241, 0.05);
                border-radius: 0.5rem;
                transition: all 0.3s ease;
            }

            .feature-detail-item:hover {
                background: rgba(99, 102, 241, 0.1);
                transform: translateX(5px);
            }

            .feature-detail-icon {
                font-size: 1.5rem;
                color: #6366f1;
                margin-top: 0.25rem;
            }

            .animate-fade-in {
                animation: fadeIn 0.5s ease-out forwards;
            }

            .contact-section {
                background: white;
                padding: 80px 0;
                position: relative;
                overflow: hidden;
            }

            .contact-card {
                background: white;
                border-radius: 16px;
                padding: 2rem;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
                border: 1px solid rgba(99, 102, 241, 0.1);
                height: 100%;
            }

            .contact-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            }

            .contact-icon {
                font-size: 2rem;
                margin-bottom: 1rem;
                color: #6366f1;
                transition: transform 0.3s ease;
            }

            .contact-card:hover .contact-icon {
                transform: scale(1.2) rotate(5deg);
            }

            .contact-form {
                background: white;
                border-radius: 16px;
                padding: 2rem;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                border: 1px solid rgba(99, 102, 241, 0.1);
            }

            .form-control {
                width: 100%;
                padding: 0.75rem 1rem;
                border: 1px solid #e2e8f0;
                border-radius: 0.375rem;
                margin-bottom: 1rem;
                transition: border-color 0.15s ease-in-out;
            }

            .form-control:focus {
                outline: none;
                border-color: #4f46e5;
                box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            }

            textarea.form-control {
                min-height: 150px;
                resize: vertical;
            }

            .btn-primary {
                background-color: #4f46e5;
                color: white;
                padding: 0.75rem 1.5rem;
                border-radius: 0.375rem;
                font-weight: 500;
                transition: background-color 0.15s ease-in-out;
                border: none;
                cursor: pointer;
                width: 100%;
            }

            .btn-primary:hover {
                background-color: #4338ca;
            }

            .alert {
                padding: 1rem;
                margin-bottom: 1rem;
                border-radius: 0.375rem;
            }

            .alert-success {
                background-color: #dcfce7;
                color: #166534;
                border: 1px solid #bbf7d0;
            }

            .alert-danger {
                background-color: #fee2e2;
                color: #991b1b;
                border: 1px solid #fecaca;
            }

            .form-group {
                @apply relative mb-6;
            }

            .error-message {
                @apply text-red-500 text-sm mt-1;
            }

            #contactMessage {
                @apply rounded-lg p-4 mb-4 text-sm;
            }

            #contactMessage.success {
                @apply bg-green-100 text-green-700 border border-green-200;
            }

            #contactMessage.error {
                @apply bg-red-100 text-red-700 border border-red-200;
            }

            .form-group.focused label {
                @apply text-indigo-600;
            }

            .form-group.error input,
            .form-group.error textarea {
                @apply border-red-500 focus:border-red-500 focus:ring-red-200;
            }

            @keyframes blob {
                0% {
                    transform: translate(0px, 0px) scale(1);
                }
                33% {
                    transform: translate(30px, -50px) scale(1.1);
                }
                66% {
                    transform: translate(-20px, 20px) scale(0.9);
                }
                100% {
                    transform: translate(0px, 0px) scale(1);
                }
            }
            
            .animate-blob {
                animation: blob 7s infinite;
            }
            
            .animation-delay-2000 {
                animation-delay: 2s;
            }
            
            .animation-delay-4000 {
                animation-delay: 4s;
            }

            @keyframes tilt {
                0%, 100% {
                    transform: rotate(0deg);
                }
                25% {
                    transform: rotate(1deg);
                }
                75% {
                    transform: rotate(-1deg);
                }
            }
            .animate-tilt {
                animation: tilt 10s infinite linear;
            }
        </style>
    </head>
    <body>
        <!-- Navigation -->
        <nav class="nav-container fixed w-full z-50 px-6 py-4">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <a href="/" class="logo-container group">
                    <div class="logo-glow"></div>
                    <span class="text-2xl gradient-text relative z-10">RoamRadar</span>
                    <div class="logo-particles"></div>
                </a>
                <div class="nav-toggle group">
                    <div class="hamburger-line"></div>
                    <div class="hamburger-line"></div>
                    <div class="hamburger-line"></div>
                </div>
                <div class="nav-menu">
                    <a href="/recommend" class="nav-link group">
                        <span class="nav-link-text">Recommend</span>
                        <span class="nav-link-glow"></span>
                        <span class="nav-link-icon"><i class="fas fa-compass"></i></span>
                    </a>
                    <a href="#features" class="nav-link group">
                        <span class="nav-link-text">Features</span>
                        <span class="nav-link-glow"></span>
                        <span class="nav-link-icon"><i class="fas fa-star"></i></span>
                    </a>
                    <a href="#contact" class="nav-link group">
                        <span class="nav-link-text">Contact</span>
                        <span class="nav-link-glow"></span>
                        <span class="nav-link-icon"><i class="fas fa-envelope"></i></span>
                    </a>
                    <a href="/recommend" class="register-button group">
                        <span class="button-content">
                            <i class="fas fa-rocket mr-2 group-hover:rotate-12 transition-transform"></i>
                            Get Started
                        </span>
                        <span class="button-glow"></span>
                        <span class="button-particles"></span>
                    </a>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="hero-section">
            <div class="hero-background">
                <div class="hero-overlay"></div>
                <div class="hero-particles" id="particles-js"></div>
            </div>
            <div class="hero-content max-w-7xl mx-auto px-6 text-center relative z-10">
                <div class="hero-badge mb-6">
                    <span class="badge-text">Discover Your Next Adventure</span>
                    <div class="badge-icon">
                        <i class="fas fa-compass"></i>
                    </div>
                </div>
                <h1 class="text-5xl sm:text-7xl font-bold mb-8 hero-title">
                    <span class="hero-title-line">Explore the World</span>
                    <span class="hero-title-line highlight">With Confidence</span>
                </h1>
                <p class="text-xl sm:text-2xl text-gray-100 mb-12 max-w-3xl mx-auto hero-description">
                    Plan your trips, explore new destinations, and create unforgettable memories with RoamRadar.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-6 hero-buttons">
                    <a href="/recommend" class="cta-button primary-button group">
                        <span class="button-content">
                            <i class="fas fa-compass mr-2 group-hover:rotate-12 transition-transform"></i>
                            Start Planning
                        </span>
                        <span class="button-glow"></span>
                    </a>
                    <a href="#features" class="cta-button secondary-button group">
                        <span class="button-content">
                            <i class="fas fa-info-circle mr-2 group-hover:scale-110 transition-transform"></i>
                            Learn More
                        </span>
                        <span class="button-glow"></span>
                    </a>
                </div>
                <div class="hero-stats mt-16 grid grid-cols-2 md:grid-cols-4 gap-4 max-w-4xl mx-auto">
                    <div class="stat-item">
                        <div class="stat-number" data-count="500">0</div>
                        <div class="stat-label">Destinations</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="10000">0</div>
                        <div class="stat-label">Happy Travelers</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="50">0</div>
                        <div class="stat-label">Countries</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="1000">0</div>
                        <div class="stat-label">Reviews</div>
                    </div>
                </div>
                <div class="hero-scroll-indicator mt-16">
                    <div class="scroll-text">Scroll to explore</div>
                    <div class="scroll-icon">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="py-24 px-6" id="features">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold mb-4 gradient-text">Why Choose RoamRadar?</h2>
                    <p class="text-xl text-gray-600">Everything you need to plan your perfect trip</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature Cards -->
                    <div class="feature-card floating-element delay-1" data-feature="smart-planning">
                        <div class="feature-icon">
                            <i class="fas fa-globe-americas"></i>
                        </div>
                        <h3 class="text-2xl font-semibold mb-4">Smart Trip Planning</h3>
                        <p class="text-gray-600">AI-powered recommendations and personalized itineraries based on your preferences.</p>
                    </div>
                    <div class="feature-card floating-element delay-2" data-feature="community-insights">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="text-2xl font-semibold mb-4">Community Insights</h3>
                        <p class="text-gray-600">Connect with fellow travelers and get authentic recommendations from locals.</p>
                    </div>
                    <div class="feature-card floating-element delay-3" data-feature="safe-travel">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="text-2xl font-semibold mb-4">Safe Travel</h3>
                        <p class="text-gray-600">Real-time safety updates and emergency assistance available 24/7.</p>
                    </div>
                </div>

                <!-- Feature Details Section -->
                <div id="featureDetails" class="hidden mt-12 p-8 bg-white rounded-xl shadow-lg transform transition-all duration-300">
                    <div class="flex justify-between items-start mb-6">
                        <h3 class="text-3xl font-bold gradient-text" id="featureTitle"></h3>
                        <button id="closeFeatureDetails" class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <div id="featureContent" class="space-y-4">
                        <!-- Content will be dynamically inserted here -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="contact-section" id="contact">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold mb-4 gradient-text">Get In Touch</h2>
                    <p class="text-xl text-gray-600">Have questions? We'd love to hear from you.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <div class="grid grid-cols-1 gap-6">
                        <div class="contact-card">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">Visit Us</h3>
                            <p class="text-gray-600">123 Travel Street, Adventure City, AC 12345</p>
                        </div>
                        <div class="contact-card">
                            <div class="contact-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">Call Us</h3>
                            <p class="text-gray-600">+1 (555) 123-4567</p>
                        </div>
                        <div class="contact-card">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">Email Us</h3>
                            <p class="text-gray-600">info@roamradar.com</p>
                        </div>
                    </div>
                    <div class="contact-form">
                        <form id="contactForm" action="{{ route('contact') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="subject" class="form-control" placeholder="Subject">
                            </div>
                            <div class="form-group">
                                <textarea name="message" class="form-control" placeholder="Your Message" required></textarea>
                            </div>
                            <div id="contactMessage" class="alert" style="display: none;"></div>
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="cta-section relative">
            <div class="hero-background">
                <div class="hero-overlay"></div>
                <div class="hero-particles" id="cta-particles-js"></div>
            </div>
            <div class="max-w-7xl mx-auto px-6 text-center relative z-10">
                <div class="cta-content-wrapper py-20">
                    <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 transform transition-all duration-500 hover:scale-105">
                        <span class="inline-block relative text-white">
                            Ready to start 
                            <div class="absolute bottom-0 left-0 w-full h-1 bg-white opacity-50 transform scale-x-0 transition-transform duration-500 group-hover:scale-x-100"></div>
                        </span>
                        <span class="inline-block relative text-transparent bg-clip-text bg-gradient-to-r from-white to-purple-200">
                            your journey?
                            <div class="absolute bottom-0 left-0 w-full h-1 bg-white opacity-50 transform scale-x-0 transition-transform duration-500 group-hover:scale-x-100"></div>
                        </span>
                    </h2>
                    <p class="text-xl md:text-2xl text-gray-100 mb-12 max-w-2xl mx-auto transform transition-all duration-500 hover:scale-105">
                        Start planning your next adventure today.
                    </p>
                    <div class="inline-block relative group">
                        <div class="absolute -inset-1 bg-gradient-to-r from-purple-600 to-pink-600 rounded-lg blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                        <a href="/recommend" class="relative inline-flex items-center justify-center px-8 py-4 text-lg font-medium text-white bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg leading-none hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl">
                            <span class="absolute inset-0 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg opacity-0 group-hover:opacity-50 transition-opacity duration-300"></span>
                            <i class="fas fa-paper-plane mr-3 transform group-hover:rotate-12 transition-transform duration-300"></i>
                            Plan Your Trip
                            <div class="absolute top-0 right-0 -mt-3 -mr-6 w-32 h-32 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-full mix-blend-multiply filter blur-xl opacity-50 animate-blob"></div>
                            <div class="absolute bottom-0 left-0 -mb-3 -ml-6 w-32 h-32 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-full mix-blend-multiply filter blur-xl opacity-50 animate-blob animation-delay-2000"></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="relative overflow-hidden bg-gradient-to-b from-indigo-900 to-[#1e1b4b]">
            <!-- Decorative elements -->
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-purple-600 via-indigo-600 to-purple-600"></div>
            <div class="absolute inset-0">
                <div class="absolute inset-0 bg-[linear-gradient(to_right,#4f46e515_1px,transparent_1px),linear-gradient(to_bottom,#4f46e515_1px,transparent_1px)] bg-[size:4rem_4rem]"></div>
                <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-indigo-900 to-transparent"></div>
            </div>
            
            <div class="relative max-w-7xl mx-auto px-6 pt-16 pb-12">
                <!-- Main footer content -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                    <!-- Brand section -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-3">
                            <div class="relative group">
                                <div class="absolute -inset-0.5 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg blur opacity-50 group-hover:opacity-75 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                                <div class="relative">
                                    <h3 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-indigo-400">
                                        RoamRadar
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-400 text-sm leading-relaxed">
                            Discover your next adventure with RoamRadar. We help you find the perfect destination based on your preferences and create unforgettable travel experiences.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="group">
                                <div class="relative p-2 bg-white/5 rounded-lg transition-all duration-300 group-hover:bg-white/10 group-hover:scale-110">
                                    <i class="fab fa-facebook-f text-gray-400 group-hover:text-purple-400 transition-colors"></i>
                                </div>
                            </a>
                            <a href="#" class="group">
                                <div class="relative p-2 bg-white/5 rounded-lg transition-all duration-300 group-hover:bg-white/10 group-hover:scale-110">
                                    <i class="fab fa-twitter text-gray-400 group-hover:text-purple-400 transition-colors"></i>
                                </div>
                            </a>
                            <a href="#" class="group">
                                <div class="relative p-2 bg-white/5 rounded-lg transition-all duration-300 group-hover:bg-white/10 group-hover:scale-110">
                                    <i class="fab fa-instagram text-gray-400 group-hover:text-purple-400 transition-colors"></i>
                                </div>
                            </a>
                            <a href="#" class="group">
                                <div class="relative p-2 bg-white/5 rounded-lg transition-all duration-300 group-hover:bg-white/10 group-hover:scale-110">
                                    <i class="fab fa-linkedin-in text-gray-400 group-hover:text-purple-400 transition-colors"></i>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h4 class="text-white font-semibold mb-6 relative inline-block">
                            Quick Links
                            <div class="absolute bottom-0 left-0 w-1/2 h-0.5 bg-gradient-to-r from-purple-600 to-transparent"></div>
                        </h4>
                        <ul class="space-y-4">
                            <li>
                                <a href="/" class="text-gray-400 hover:text-white transition-colors duration-300 flex items-center group">
                                    <span class="w-2 h-2 bg-purple-600 rounded-full mr-2 transform scale-0 group-hover:scale-100 transition-transform"></span>
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="/recommend" class="text-gray-400 hover:text-white transition-colors duration-300 flex items-center group">
                                    <span class="w-2 h-2 bg-purple-600 rounded-full mr-2 transform scale-0 group-hover:scale-100 transition-transform"></span>
                                    Recommend
                                </a>
                            </li>
                            <li>
                                <a href="#features" class="text-gray-400 hover:text-white transition-colors duration-300 flex items-center group">
                                    <span class="w-2 h-2 bg-purple-600 rounded-full mr-2 transform scale-0 group-hover:scale-100 transition-transform"></span>
                                    Features
                                </a>
                            </li>
                            <li>
                                <a href="#contact" class="text-gray-400 hover:text-white transition-colors duration-300 flex items-center group">
                                    <span class="w-2 h-2 bg-purple-600 rounded-full mr-2 transform scale-0 group-hover:scale-100 transition-transform"></span>
                                    Contact
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Popular Destinations -->
                    <div>
                        <h4 class="text-white font-semibold mb-6 relative inline-block">
                            Popular Destinations
                            <div class="absolute bottom-0 left-0 w-1/2 h-0.5 bg-gradient-to-r from-purple-600 to-transparent"></div>
                        </h4>
                        <ul class="space-y-4">
                            <li>
                                <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300 flex items-center group">
                                    <span class="w-2 h-2 bg-purple-600 rounded-full mr-2 transform scale-0 group-hover:scale-100 transition-transform"></span>
                                    Beach Getaways
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300 flex items-center group">
                                    <span class="w-2 h-2 bg-purple-600 rounded-full mr-2 transform scale-0 group-hover:scale-100 transition-transform"></span>
                                    Mountain Adventures
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300 flex items-center group">
                                    <span class="w-2 h-2 bg-purple-600 rounded-full mr-2 transform scale-0 group-hover:scale-100 transition-transform"></span>
                                    City Breaks
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300 flex items-center group">
                                    <span class="w-2 h-2 bg-purple-600 rounded-full mr-2 transform scale-0 group-hover:scale-100 transition-transform"></span>
                                    Cultural Tours
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Newsletter -->
                    <div>
                        <h4 class="text-white font-semibold mb-6 relative inline-block">
                            Stay Updated
                            <div class="absolute bottom-0 left-0 w-1/2 h-0.5 bg-gradient-to-r from-purple-600 to-transparent"></div>
                        </h4>
                        <p class="text-gray-400 text-sm mb-4">Subscribe to our newsletter for travel tips and exclusive offers.</p>
                        <form class="space-y-3">
                            <div class="relative group">
                                <div class="absolute -inset-0.5 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg blur opacity-50 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                                <input type="email" placeholder="Your email address" class="relative w-full px-4 py-2 bg-black/20 border border-white/10 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 text-gray-300 placeholder-gray-500">
                            </div>
                            <button type="submit" class="w-full px-4 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 transform hover:-translate-y-0.5">
                                Subscribe
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Bottom bar -->
                <div class="pt-8 mt-12 border-t border-white/10">
                    <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                        <p class="text-gray-400 text-sm">
                            © {{ date('Y') }} RoamRadar. All rights reserved.
                        </p>
                        <div class="flex space-x-6">
                            <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-300">Privacy Policy</a>
                            <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-300">Terms of Service</a>
                            <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-300">Cookie Policy</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <script>
            // Add smooth scrolling
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            // Navbar scroll effect
            window.addEventListener('scroll', function() {
                const nav = document.querySelector('.nav-container');
                const scrollPosition = window.scrollY;
                
                if (scrollPosition > 50) {
                    nav.classList.add('scrolled');
                    
                    // Add parallax effect to nav items
                    const navItems = document.querySelectorAll('.nav-link, .register-button');
                    navItems.forEach((item, index) => {
                        const delay = index * 0.05;
                        item.style.transform = `translateY(${scrollPosition * 0.01}px)`;
                        item.style.transitionDelay = `${delay}s`;
                    });
                } else {
                    nav.classList.remove('scrolled');
                    
                    // Reset nav items
                    const navItems = document.querySelectorAll('.nav-link, .register-button');
                    navItems.forEach(item => {
                        item.style.transform = 'translateY(0)';
                        item.style.transitionDelay = '0s';
                    });
                }
            });

            // Mobile menu toggle
            const navToggle = document.querySelector('.nav-toggle');
            const navMenu = document.querySelector('.nav-menu');
            
            navToggle.addEventListener('click', function() {
                navToggle.classList.toggle('active');
                navMenu.classList.toggle('active');
                
                // Add animation to menu items
                const menuItems = document.querySelectorAll('.nav-menu a');
                menuItems.forEach((item, index) => {
                    if (navMenu.classList.contains('active')) {
                        item.style.animation = `slideIn 0.3s ease forwards ${index * 0.1}s`;
                    } else {
                        item.style.animation = '';
                    }
                });
            });

            // Close mobile menu when clicking on a link
            document.querySelectorAll('.nav-menu a').forEach(link => {
                link.addEventListener('click', () => {
                    navToggle.classList.remove('active');
                    navMenu.classList.remove('active');
                });
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

            document.querySelectorAll('.feature-card, .contact-card, .contact-form').forEach(el => {
                observer.observe(el);
            });

            document.getElementById('contactForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                const form = this;
                const submitButton = form.querySelector('button[type="submit"]');
                const messageDiv = document.getElementById('contactMessage');
                
                // Disable submit button and show loading state
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
                
                // Clear previous messages
                messageDiv.style.display = 'none';
                messageDiv.className = 'alert';
                
                fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    messageDiv.textContent = data.message;
                    messageDiv.style.display = 'block';
                    
                    if (data.success) {
                        messageDiv.classList.add('alert-success');
                        form.reset();
                    } else {
                        messageDiv.classList.add('alert-danger');
                    }
                })
                .catch(error => {
                    messageDiv.textContent = 'An error occurred. Please try again.';
                    messageDiv.style.display = 'block';
                    messageDiv.classList.add('alert-danger');
                })
                .finally(() => {
                    submitButton.disabled = false;
                    submitButton.innerHTML = 'Send Message';
                });
            });

            // Add focus effects
            document.querySelectorAll('.form-input, .form-textarea').forEach(input => {
                input.addEventListener('focus', function() {
                    this.closest('.form-group').classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    this.closest('.form-group').classList.remove('focused');
                });
            });

            const featureDetails = {
                'smart-planning': {
                    title: 'Smart Trip Planning',
                    content: [
                        {
                            icon: 'fa-robot',
                            title: 'AI-Powered Recommendations',
                            description: 'Our advanced AI algorithm analyzes your preferences, budget, and travel style to suggest the perfect destinations and activities.'
                        },
                        {
                            icon: 'fa-calendar-alt',
                            title: 'Personalized Itineraries',
                            description: 'Get custom day-by-day itineraries that match your interests and pace, with flexible options to modify as needed.'
                        },
                        {
                            icon: 'fa-chart-line',
                            title: 'Budget Optimization',
                            description: 'Smart budget allocation to maximize your travel experience while staying within your financial constraints.'
                        }
                    ]
                },
                'community-insights': {
                    title: 'Community Insights',
                    content: [
                        {
                            icon: 'fa-comments',
                            title: 'Traveler Reviews',
                            description: 'Access authentic reviews and experiences from fellow travelers who have visited your desired destinations.'
                        },
                        {
                            icon: 'fa-user-friends',
                            title: 'Local Connections',
                            description: 'Connect with locals who can provide insider tips and hidden gems not found in typical travel guides.'
                        },
                        {
                            icon: 'fa-map-marked-alt',
                            title: 'Community Recommendations',
                            description: 'Discover off-the-beaten-path locations and experiences recommended by our global travel community.'
                        }
                    ]
                },
                'safe-travel': {
                    title: 'Safe Travel',
                    content: [
                        {
                            icon: 'fa-shield-alt',
                            title: 'Real-Time Safety Updates',
                            description: 'Stay informed with up-to-date safety information and travel advisories for your destinations.'
                        },
                        {
                            icon: 'fa-phone-alt',
                            title: '24/7 Emergency Support',
                            description: 'Access to emergency assistance and support services whenever you need them, anywhere in the world.'
                        },
                        {
                            icon: 'fa-first-aid',
                            title: 'Health & Safety Resources',
                            description: 'Comprehensive health information, vaccination requirements, and local healthcare resources.'
                        }
                    ]
                }
            };

            document.querySelectorAll('.feature-card').forEach(card => {
                card.addEventListener('click', function() {
                    const feature = this.dataset.feature;
                    const details = featureDetails[feature];
                    
                    if (details) {
                        const detailsSection = document.getElementById('featureDetails');
                        const titleElement = document.getElementById('featureTitle');
                        const contentElement = document.getElementById('featureContent');
                        
                        // Update content
                        titleElement.textContent = details.title;
                        contentElement.innerHTML = details.content.map(item => `
                            <div class="feature-detail-item">
                                <div class="feature-detail-icon">
                                    <i class="fas ${item.icon}"></i>
                                </div>
                                <div>
                                    <h4 class="text-xl font-semibold mb-2">${item.title}</h4>
                                    <p class="text-gray-600">${item.description}</p>
                                </div>
                            </div>
                        `).join('');
                        
                        // Show details section
                        detailsSection.classList.remove('hidden');
                        setTimeout(() => {
                            detailsSection.classList.add('show');
                        }, 10);
                        
                        // Scroll to details section
                        detailsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                });
            });

            document.getElementById('closeFeatureDetails').addEventListener('click', function() {
                const detailsSection = document.getElementById('featureDetails');
                detailsSection.classList.remove('show');
                setTimeout(() => {
                    detailsSection.classList.add('hidden');
                }, 300);
            });

            // Add particles.js for interactive background
            document.addEventListener('DOMContentLoaded', function() {
                // Load particles.js script
                const script = document.createElement('script');
                script.src = 'https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js';
                script.onload = function() {
                    particlesJS('particles-js', {
                        particles: {
                            number: {
                                value: 80,
                                density: {
                                    enable: true,
                                    value_area: 800
                                }
                            },
                            color: {
                                value: '#ffffff'
                            },
                            shape: {
                                type: 'circle',
                                stroke: {
                                    width: 0,
                                    color: '#000000'
                                },
                                polygon: {
                                    nb_sides: 5
                                }
                            },
                            opacity: {
                                value: 0.5,
                                random: false,
                                anim: {
                                    enable: false,
                                    speed: 1,
                                    opacity_min: 0.1,
                                    sync: false
                                }
                            },
                            size: {
                                value: 3,
                                random: true,
                                anim: {
                                    enable: false,
                                    speed: 40,
                                    size_min: 0.1,
                                    sync: false
                                }
                            },
                            line_linked: {
                                enable: true,
                                distance: 150,
                                color: '#ffffff',
                                opacity: 0.4,
                                width: 1
                            },
                            move: {
                                enable: true,
                                speed: 2,
                                direction: 'none',
                                random: false,
                                straight: false,
                                out_mode: 'out',
                                bounce: false,
                                attract: {
                                    enable: false,
                                    rotateX: 600,
                                    rotateY: 1200
                                }
                            }
                        },
                        interactivity: {
                            detect_on: 'canvas',
                            events: {
                                onhover: {
                                    enable: true,
                                    mode: 'grab'
                                },
                                onclick: {
                                    enable: true,
                                    mode: 'push'
                                },
                                resize: true
                            },
                            modes: {
                                grab: {
                                    distance: 140,
                                    line_linked: {
                                        opacity: 1
                                    }
                                },
                                bubble: {
                                    distance: 400,
                                    size: 40,
                                    duration: 2,
                                    opacity: 8,
                                    speed: 3
                                },
                                repulse: {
                                    distance: 200,
                                    duration: 0.4
                                },
                                push: {
                                    particles_nb: 4
                                },
                                remove: {
                                    particles_nb: 2
                                }
                            }
                        },
                        retina_detect: true
                    });
                };
                document.head.appendChild(script);

                // Animate stats numbers
                const stats = document.querySelectorAll('.stat-number');
                const observerOptions = {
                    root: null,
                    rootMargin: '0px',
                    threshold: 0.5
                };

                const observer = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const target = entry.target;
                            const countTo = parseInt(target.getAttribute('data-count'));
                            let count = 0;
                            const duration = 2000; // 2 seconds
                            const step = countTo / (duration / 16); // 60fps

                            const updateCount = () => {
                                count += step;
                                if (count < countTo) {
                                    target.textContent = Math.floor(count);
                                    requestAnimationFrame(updateCount);
                                } else {
                                    target.textContent = countTo;
                                }
                            };

                            updateCount();
                            observer.unobserve(target);
                        }
                    });
                }, observerOptions);

                stats.forEach(stat => {
                    observer.observe(stat);
                });

                // Add particles to logo
                const logoParticles = document.querySelector('.logo-particles');
                if (logoParticles) {
                    particlesJS('logo-particles', {
                        particles: {
                            number: {
                                value: 10,
                                density: {
                                    enable: true,
                                    value_area: 800
                                }
                            },
                            color: {
                                value: '#6366f1'
                            },
                            shape: {
                                type: 'circle',
                                stroke: {
                                    width: 0,
                                    color: '#000000'
                                },
                                polygon: {
                                    nb_sides: 5
                                }
                            },
                            opacity: {
                                value: 0.5,
                                random: false,
                                anim: {
                                    enable: false,
                                    speed: 1,
                                    opacity_min: 0.1,
                                    sync: false
                                }
                            },
                            size: {
                                value: 3,
                                random: true,
                                anim: {
                                    enable: false,
                                    speed: 40,
                                    size_min: 0.1,
                                    sync: false
                                }
                            },
                            line_linked: {
                                enable: true,
                                distance: 150,
                                color: '#6366f1',
                                opacity: 0.4,
                                width: 1
                            },
                            move: {
                                enable: true,
                                speed: 2,
                                direction: 'none',
                                random: false,
                                straight: false,
                                out_mode: 'out',
                                bounce: false,
                                attract: {
                                    enable: false,
                                    rotateX: 600,
                                    rotateY: 1200
                                }
                            }
                        },
                        interactivity: {
                            detect_on: 'canvas',
                            events: {
                                onhover: {
                                    enable: true,
                                    mode: 'grab'
                                },
                                onclick: {
                                    enable: true,
                                    mode: 'push'
                                },
                                resize: true
                            },
                            modes: {
                                grab: {
                                    distance: 140,
                                    line_linked: {
                                        opacity: 1
                                    }
                                },
                                bubble: {
                                    distance: 400,
                                    size: 40,
                                    duration: 2,
                                    opacity: 8,
                                    speed: 3
                                },
                                repulse: {
                                    distance: 200,
                                    duration: 0.4
                                },
                                push: {
                                    particles_nb: 4
                                },
                                remove: {
                                    particles_nb: 2
                                }
                            }
                        },
                        retina_detect: true
                    });
                }

                // Add particles to register button
                const buttonParticles = document.querySelectorAll('.button-particles');
                buttonParticles.forEach((particle, index) => {
                    particlesJS(`button-particles-${index}`, {
                        particles: {
                            number: {
                                value: 5,
                                density: {
                                    enable: true,
                                    value_area: 800
                                }
                            },
                            color: {
                                value: '#ffffff'
                            },
                            shape: {
                                type: 'circle',
                                stroke: {
                                    width: 0,
                                    color: '#000000'
                                },
                                polygon: {
                                    nb_sides: 5
                                }
                            },
                            opacity: {
                                value: 0.5,
                                random: false,
                                anim: {
                                    enable: false,
                                    speed: 1,
                                    opacity_min: 0.1,
                                    sync: false
                                }
                            },
                            size: {
                                value: 2,
                                random: true,
                                anim: {
                                    enable: false,
                                    speed: 40,
                                    size_min: 0.1,
                                    sync: false
                                }
                            },
                            line_linked: {
                                enable: false,
                                distance: 150,
                                color: '#ffffff',
                                opacity: 0.4,
                                width: 1
                            },
                            move: {
                                enable: true,
                                speed: 1,
                                direction: 'none',
                                random: false,
                                straight: false,
                                out_mode: 'out',
                                bounce: false,
                                attract: {
                                    enable: false,
                                    rotateX: 600,
                                    rotateY: 1200
                                }
                            }
                        },
                        interactivity: {
                            detect_on: 'canvas',
                            events: {
                                onhover: {
                                    enable: true,
                                    mode: 'grab'
                                },
                                onclick: {
                                    enable: true,
                                    mode: 'push'
                                },
                                resize: true
                            },
                            modes: {
                                grab: {
                                    distance: 140,
                                    line_linked: {
                                        opacity: 1
                                    }
                                },
                                bubble: {
                                    distance: 400,
                                    size: 40,
                                    duration: 2,
                                    opacity: 8,
                                    speed: 3
                                },
                                repulse: {
                                    distance: 200,
                                    duration: 0.4
                                },
                                push: {
                                    particles_nb: 4
                                },
                                remove: {
                                    particles_nb: 2
                                }
                            }
                        },
                        retina_detect: true
                    });
                });
            });

            // Initialize particles for CTA section
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof particlesJS !== 'undefined') {
                    particlesJS('cta-particles-js', {
                        particles: {
                            number: {
                                value: 80,
                                density: {
                                    enable: true,
                                    value_area: 800
                                }
                            },
                            color: {
                                value: '#ffffff'
                            },
                            shape: {
                                type: 'circle'
                            },
                            opacity: {
                                value: 0.5,
                                random: false,
                                anim: {
                                    enable: false
                                }
                            },
                            size: {
                                value: 3,
                                random: true
                            },
                            line_linked: {
                                enable: true,
                                distance: 150,
                                color: '#ffffff',
                                opacity: 0.4,
                                width: 1
                            },
                            move: {
                                enable: true,
                                speed: 2,
                                direction: 'none',
                                random: false,
                                straight: false,
                                out_mode: 'out',
                                bounce: false
                            }
                        },
                        interactivity: {
                            detect_on: 'canvas',
                            events: {
                                onhover: {
                                    enable: true,
                                    mode: 'grab'
                                },
                                onclick: {
                                    enable: true,
                                    mode: 'push'
                                },
                                resize: true
                            }
                        },
                        retina_detect: true
                    });
                }
            });
        </script>
    </body>
</html>
