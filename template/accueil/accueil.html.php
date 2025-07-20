<?php $solde = $this->session->get('solde'); ?>
<div class="w-[60rem] mt-[-43.2rem] mx-auto p-4 ml-[25rem]  ">
            <!-- Header Section -->
            <div class="orange-gradient rounded-2xl p-6 mb-6 relative overflow-hidden animate-slide-in">
                <div class="absolute -left-20 top-0 w-40 h-40 bg-black rounded-full opacity-20"></div>
                <div class="absolute -right-16 -top-16 w-32 h-32 bg-white rounded-full opacity-10"></div>
                
                <!-- Greeting -->
                <div class="relative z-10 mb-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-white text-lg font-medium">Bonjour,</h1>
                            <h2 class="text-white text-2xl font-bold"></h2>
                        </div>
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <span class="text-white text-lg">👋</span>
                        </div>
                    </div>
                </div>
                
                <!-- Balance Section -->
                <div class="text-center relative z-10">
    <h3 class="text-white text-lg font-medium mb-4">Solde Principal</h3>
            <div class="flex items-center justify-center">
                <button class="flex items-center glass-effect rounded-full px-6 py-3 hover:bg-white hover:bg-opacity-20 transition-all">
                    <i data-lucide="eye" class="w-6 h-6 text-white mr-3"></i>
                    <i data-lucide="eye-off" class="w-6 h-6 text-white mr-3"></i>
                    <!-- <span class="text-white text-xl font-bold"></span> -->
                    <p class ="text-white text-xl font-bold">
                            <?=  $solde ?> FCFA
                    </p>
                </button>
            </div>
</div>

            </div>

            <!-- Account Section -->
            <div class="mb-6 animate-slide-in animate-delay-1">
                <h3 class="text-gray-800 font-semibold mb-4">Mon compte</h3>
                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mr-4">
                                <i data-lucide="wallet" class="w-6 h-6 text-yellow-600"></i>
                            </div>
                            <div>
                                <h4 class="text-gray-800 font-medium">Compte Principal</h4>
                                <p class="text-gray-500 text-sm">785225400</p>
                            </div>
                        </div>
                        <button class="p-2 hover:bg-gray-100 rounded-lg">
                            <i data-lucide="qr-code" class="w-6 h-6 text-gray-600"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions -->
            <div class="animate-slide-in animate-delay-2">
                <h3 class="text-gray-800 font-semibold mb-4">Transactions récentes</h3>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="p-4 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                    <i data-lucide="arrow-down" class="w-5 h-5 text-green-600"></i>
                                </div>
                                <div>
                                    <h4 class="text-gray-800 font-medium">Reçu de Mohamed</h4>
                                    <p class="text-gray-500 text-sm">Aujourd'hui 14:30</p>
                                </div>
                            </div>
                            <span class="text-green-600 font-semibold">+15,000 FCFA</span>
                        </div>
                    </div>
                    <div class="p-4 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-3">
                                    <i data-lucide="arrow-up" class="w-5 h-5 text-red-600"></i>
                                </div>
                                <div>
                                    <h4 class="text-gray-800 font-medium">Transfert vers Aminata</h4>
                                    <p class="text-gray-500 text-sm">Hier 09:15</p>
                                </div>
                            </div>
                            <span class="text-red-600 font-semibold">-8,500 FCFA</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                    <i data-lucide="smartphone" class="w-5 h-5 text-blue-600"></i>
                                </div>
                                <div>
                                    <h4 class="text-gray-800 font-medium">Achat crédit 3GB</h4>
                                    <p class="text-gray-500 text-sm">15 Jan 16:45</p>
                                </div>
                            </div>
                            <span class="text-red-600 font-semibold">-2,000 FCFA</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
