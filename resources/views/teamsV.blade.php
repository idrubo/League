<!DOCTYPE html>

<!-- DEBUG -->
<!-- DEBUG -->
<!-- DEBUG -->
<!-- Error variables must be rendered through -->
<!--
To place a view at Laravel:

-->
<!-- DEBUG -->
<!-- DEBUG -->
<!-- DEBUG -->

<html>

  <head>
    <title>Professional Football League</title>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="images/football.svg">
<!-- <link rel="stylesheet" href="CSS/League.css"> -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>

  <body class="max-w-screen-xl m-auto flex flex-col">

<!-- Header -->

    <header class="mt-2.5 mr-0 mb-0 ml-0" >

      <nav class="p-1 bg-LightBlue Arial sans-serif text-base font-bold">
        <a class="pt-0 pr-2.5 pb-0 pl-1 text-Navy no-underline hover:no-underline hover:bg-Gold" href="teams.php">Teams</a>
        <a class="pt-0 pr-2.5 pb-0 pl-1 text-Navy no-underline hover:no-underline hover:bg-Gold" href="players.php">Players</a>
        <a class="pt-0 pr-2.5 pb-0 pl-1 text-Navy no-underline hover:no-underline hover:bg-Gold" href="games.php">Games</a>
      </nav>

      <div class="bg-MidnightBlue text-BlanchedAlmond flex justify-center">
        <h1 class="p-1 text-4xl font-bold">Professional Football League</h1>
      </div>

    </header>

<!-- Header -->

    <main class="pt-2.5 pr-1 pb-2.5 pl-2.5 bg-LightBlue text-Navy flex flex-col">

<!-- Labels -->

      <div class="flex flex-row">
        <div class="m-1 text-xl font-bold basis-2/4 flex justify-start">        <h3>Manage Teams</h3></div>
        <div class="m-1 text-xl font-bold basis-2/4 flex justify-start visible"><h3>Show Teams</h3></div>
      </div>

<!-- Labels -->

      <div class="flex flex-row">

<!-- Column 1 -->

        <div class="m-1 bg-BurlyWood basis-2/4 flex justify-center">
          <div class="m-2.5 p-2.5 flex flex-column">

            <form action="">

<!-- Text input 1 -->

              <div class="flex flex-row justify-start"> 
                <div class="mt-0 mr-0 mb-2.5 ml-0 bg-white border-2 border-solid border-Navy placeholder-Gray">
                  <input type="text" name="team" placeholder="Team" class="w-full">
                </div>
                <div class="pt-0 pr-0 pb-0 pl-1 text-red-500 font-bold">
                  <?php echo $GLOBALS ['teaErr']; ?>
                </div>
              </div>

              <div class="flex flex-row justify-start"> 
                <div class="mt-0 mr-0 mb-2.5 ml-0 bg-white border-2 border-solid border-Navy placeholder-Gray">
                  <input type="text" name="address" placeholder="Address" class="w-full">
                </div>
                <div class="pt-0 pr-0 pb-0 pl-1 text-red-500 font-bold">
                  <?php echo $GLOBALS ['addErr']; ?>
                </div>
              </div>

              <div class="flex flex-row justify-start"> 
                <div class="mt-0 mr-0 mb-2.5 ml-0 bg-white border-2 border-solid border-Navy placeholder-Gray">

                  <input type="text" name="phone" placeholder="Phone" class="w-full">
                </div>
                <div class="pt-0 pr-0 pb-0 pl-1 text-red-500 font-bold">
                  <?php echo $GLOBALS ['phoErr']; ?>
                </div>
              </div>

<!-- Text input 1 -->

<!-- Submit button 1 -->

              <div class="m-1 border-none bg-Navy text-white text-center hover:bg-MediumBlue">
                <button type="submit" name="update" value="update" class="w-full">Create</button>
              </div>
              <div class="m-1 border-none bg-Navy text-white text-center hover:bg-MediumBlue">
                <button type="submit" name="update" value="update" class="w-full">Update</button>
              </div>
              <div class="m-1 border-none bg-Navy text-white text-center hover:bg-MediumBlue">
                <button type="submit" name="show" value="show" class="w-full">Show</button>
              </div>
              <div class="m-1 border-none bg-Navy text-white text-center hover:bg-MediumBlue">
                <button type="submit" name="all" value="all" class="w-full">All</button>
              </div>

<!-- Submit button 1 -->

            </form>

          </div>
        </div>

<!-- Column 1 -->

<!-- Column 2 -->

        <div class="m-1 bg-BurlyWood basis-2/4 flex justify-center visible">
          <div class="m-2.5 p-2.5 flex flex-column">

          </div>
        </div>

<!-- Column 2 -->

      </div>
    </main>
  </body>
</html>

