<nav class="bg-indigo-600 ">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <a href="#" class="text-white font-bold text-xl"><?php 
                include("../../services/auth/auth.php");
                permesion("../home.php",1);
                
                
                ?></a>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="accueil.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">accueil</a>
                        <a href="listeleve.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">listes étudiants</a>
                        <a href="tableautemps.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">emploi du temps</a>
                    </div>
                </div>
            </div>
            <div class="flex items-center">
             
              
                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"  name="logout">
                  <a href="../../services/auth/logout.php">  Déconnecter</a>
                </button>
            </div>
        </div>
    </div>
    <!-- Mobile menu, toggle classNamees based on menu state.
  
      Menu open: "block", Menu closed: "hidden"
    -->
    <div class="hidden md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
        <a href="accueil.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">accueil</a>
       <a href="listeleve.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">list d'eleve</a>
       <a href="tableautemps.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">emploi de temp</a>
        </div>
    </div>
</nav>
