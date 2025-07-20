  <div id="sidebar" class="sidebar fixed left-0 top-0 h-full w-80 bg-white shadow-2xl z-50 overflow-y-auto md:shadow-none md:border-r md:border-gray-200">
        <div class="p-6">
            <!-- Sidebar Header (mobile only) -->
            <div class="flex items-center justify-between mb-8 md:hidden">
                <div class="flex items-center">
                    <div class="w-12 h-12 orange-gradient rounded-full flex items-center justify-center mr-3">
                        <span class="text-white font-bold text-lg">M</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800">Maxit</h3>
                        <p class="text-sm text-gray-500">Orange Money</p>
                    </div>
                </div>
                <button id="close-sidebar" class="p-2 hover:bg-gray-100 rounded-lg">
                    <i data-lucide="x" class="w-5 h-5 text-gray-600"></i>
                </button>
            </div>
            
            <!-- User Profile -->
            <div class="bg-gradient-to-r from-orange-400 to-yellow-400 rounded-xl p-4 mb-6">
                <div class="flex items-center mb-3">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mr-3">
                        <span class="text-orange-500 font-bold">LS</span>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold"></h4>
                        <p class="text-white text-sm opacity-90">
                            <?php
                           
                           echo $this->session->get("telephone")[0];
                            // var_dump($this->session->get("telephone")[0]);die;

                        //    var_dump($this->session->get('user')->getTelephones());die;
                            
                            ?>
                        </p>
                    </div>
                </div>
                <div class="text-white text-sm">
                    <span class="opacity-75">Solde: </span>
                    <span class="font-semibold">25,000 FCFA</span>
                </div>
            </div>
            
            <!-- Actions Rapides Section -->
            <div class="mb-6">
                <h3 class="text-gray-800 font-semibold mb-4">Actions rapides</h3>
                <div class="space-y-3">
                    <!-- Transfert -->
                    <button class="w-full bg-gray-50 rounded-lg p-4 flex items-center hover:bg-orange-50 hover:text-orange-600 transition-colors">
                        <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                            <i data-lucide="send" class="w-5 h-5 text-orange-600"></i>
                        </div>
                        <div class="text-left">
                            <h4 class="font-medium text-gray-800">Transfert</h4>
                            <p class="text-sm text-gray-500">Envoyer de l'argent</p>
                        </div>
                    </button>

                    <!-- Paiement -->
                    <button class="w-full bg-gray-50 rounded-lg p-4 flex items-center hover:bg-purple-50 hover:text-purple-600 transition-colors">
                        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                            <i data-lucide="credit-card" class="w-5 h-5 text-purple-600"></i>
                        </div>
                        <div class="text-left">
                            <h4 class="font-medium text-gray-800">Paiement</h4>
                            <p class="text-sm text-gray-500">Payer vos factures</p>
                        </div>
                    </button>

                    <!-- Pass Internet -->
                    <button class="w-full bg-gray-50 rounded-lg p-4 flex items-center hover:bg-blue-50 hover:text-blue-600 transition-colors">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <i data-lucide="smartphone" class="w-5 h-5 text-blue-600"></i>
                        </div>
                        <div class="text-left">
                            <h4 class="font-medium text-gray-800">Pass Internet</h4>
                            <p class="text-sm text-gray-500">Acheter du crédit</p>
                        </div>
                    </button>

                    <!-- Recharge -->
                    <button class="w-full bg-gray-50 rounded-lg p-4 flex items-center hover:bg-green-50 hover:text-green-600 transition-colors">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                            <i data-lucide="plus-circle" class="w-5 h-5 text-green-600"></i>
                        </div>
                        <div class="text-left">
                            <h4 class="font-medium text-gray-800">Recharge</h4>
                            <p class="text-sm text-gray-500">Recharger compte</p>
                        </div>
                    </button>
                </div>
            </div>
            
            <!-- Menu Items -->
          
            
            <!-- Logout -->
            <div class="mt-auto">
                <button class="flex items-center px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg transition-colors w-full">
                    <i data-lucide="log-out" class="w-5 h-5 mr-3"></i>
                    <span>Déconnexion</span>
                </button>
            </div>
        </div>
    </div>