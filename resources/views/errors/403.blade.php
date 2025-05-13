<!DOCTYPE html>
   <html>
   <head>
       <title>403 Forbidden</title>
       <link href="{{ asset('css/app.css') }}" rel="stylesheet">
       @vite(['resources/css/app.css', 'resources/js/app.js'])
   </head>
   <body class="bg-gray-100">
       <div class="min-h-screen flex items-center justify-center">
           <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
               <h1 class="text-2xl font-bold text-red-600 mb-4">403 Forbidden</h1>
               <p class="text-gray-600 mb-6">You do not have permission to access this page.</p>
               <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                   Back to Dashboard
               </a>
           </div>
       </div>
   </body>
   </html>