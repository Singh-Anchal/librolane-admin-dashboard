<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Principal Login - PKS Public School</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" rel="stylesheet" />

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Lexend', 'sans-serif'],
                    },
                    colors: {
                        // Design wala Dark Theme Colors
                        navy: {
                            800: '#1e293b',
                            900: '#0f172a', 
                            950: '#020617',
                        },
                        // Design wala Green Accent
                        accent: {
                            500: '#10b981', 
                            600: '#059669',
                        }
                    }
                },
            },
        }
    </script>
    <style>
        /* Grid Background Pattern */
        .bg-grid-pattern {
            background-color: #f8fafc;
            background-image: linear-gradient(#e2e8f0 1px, transparent 1px), linear-gradient(90deg, #e2e8f0 1px, transparent 1px);
            background-size: 40px 40px;
        }
    </style>
</head>
<body class="font-sans text-slate-900 bg-grid-pattern min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8">

    <div class="bg-white w-full max-w-5xl h-auto min-h-[600px] rounded-2xl shadow-2xl flex flex-col lg:flex-row overflow-hidden border border-slate-100">

        <div class="w-full lg:w-1/2 bg-navy-900 text-white p-12 flex flex-col justify-between relative overflow-hidden">
            
            <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-accent-500/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="flex items-center gap-3 z-10">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/10 backdrop-blur-sm border border-white/10">
                    <img alt="PKS Public School Logo" class="h-6 w-6" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAo79EyrQEqtQl5kD5bpGS7c5xCBZM6_IPQOoNQbqpbUuqXq7fNDZLJvvolwKypfeQgb5gjwNPcSZuY0TBEINoT9Poy4LKb3F95gqKyKr8eJRH2KBwY7mVElMVcKZMFHhuiG2Ynh-VLDLDuxDNgfXkS4-ubQvg-GQH1XqPTv2yLmYoYzXbLRC2VsIvPi_WkbpiKJP1PRyCaBcgm-1PR8MId79DGZ0gHlW7R4l-qDD1g1c5kPQq_6m0yO6bD8LoXu5dftSjfutjYUck"/>
                </div>
                <span class="text-lg font-semibold tracking-wide">PKS Portal</span>
            </div>

            <div class="z-10 mt-10 lg:mt-0">
                <h1 class="text-3xl lg:text-4xl font-bold leading-tight mb-6">
                    PKS Public School <br>
                    <span class="text-accent-500">Portal</span>
                </h1>
                
                <p class="text-slate-400 text-lg font-light leading-relaxed max-w-sm">
                    Your central hub for academic excellence and community engagement.
                </p>

                <div class="mt-8 space-y-4">
                    <div class="flex items-center gap-3 text-sm text-slate-300">
                        <span class="material-symbols-rounded text-accent-500">check_circle</span>
                        <span>Administrative Dashboard</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm text-slate-300">
                        <span class="material-symbols-rounded text-accent-500">shield</span>
                        <span>Secure Principal Access</span>
                    </div>
                </div>
            </div>

            <div class="text-slate-500 text-xs mt-12 lg:mt-0 z-10">
                © 2024 PKS Public School. All rights reserved.
            </div>
        </div>

        <div class="w-full lg:w-1/2 bg-white p-8 sm:p-12 lg:p-16 flex flex-col justify-center">
            
            <div class="w-full max-w-sm mx-auto flex flex-col gap-6">
                
                <div class="flex flex-col gap-2">
                    <h2 class="text-navy-900 text-2xl font-bold leading-tight">Welcome Back</h2>
                    <p class="text-slate-500 text-base font-normal">Please enter your credentials to access the administrative dashboard.</p>
                </div>

                <div class="flex flex-col gap-5">
                    
                    <label class="flex flex-col w-full gap-2">
                        <span class="text-navy-900 text-sm font-medium">Email Address / Username</span>
                        <input class="w-full px-4 py-3 rounded-lg border border-slate-200 text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-accent-500/20 focus:border-accent-500 transition-all" 
                               placeholder="e.g., principal@pksschool.edu" 
                               value=""/>
                    </label>

                    <label class="flex flex-col w-full gap-2">
                        <div class="flex justify-between items-center">
                            <span class="text-navy-900 text-sm font-medium">Password</span>
                            <a class="text-sm font-medium text-accent-500 hover:text-accent-600 hover:underline transition-colors" href="#">Forgot Password?</a>
                        </div>
                        <input class="w-full px-4 py-3 rounded-lg border border-slate-200 text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-accent-500/20 focus:border-accent-500 transition-all" 
                               placeholder="Enter your password" 
                               type="password" 
                               value=""/>
                    </label>

                    <button class="flex h-12 w-full items-center justify-center rounded-lg bg-navy-900 px-6 text-base font-medium text-white shadow-lg shadow-navy-900/20 transition-all hover:bg-navy-800 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-navy-900 focus:ring-offset-2">
                        Sign In
                    </button>

                    <p class="text-center text-sm text-slate-500">
                        Need help? <a class="font-medium text-accent-500 hover:text-accent-600 hover:underline" href="#">Contact Support</a>
                    </p>
                </div>

            </div>
        </div>
    </div>

</body>
</html>