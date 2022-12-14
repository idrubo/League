<!DOCTYPE html>

<html>

  <head>
    <title>Football League</title>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="../images/football.svg">
    <link rel="stylesheet" href="../css/app.css">
  </head>

  <body class="max-w-screen-xl m-auto flex flex-col">

<!-- Header -->

    <header class="mt-2.5 mr-0 mb-0 ml-0" >

      <nav class="p-1 bg-LightBlue Arial sans-serif text-base font-bold">
        <a class="pt-0 pr-2.5 pb-0 pl-1 text-Navy no-underline hover:no-underline hover:bg-Gold" href="/teams/">Teams</a>
        <a class="pt-0 pr-2.5 pb-0 pl-1 text-Navy no-underline hover:no-underline hover:bg-Gold" href="/players/">Players</a>
        <a class="pt-0 pr-2.5 pb-0 pl-1 text-Navy no-underline hover:no-underline hover:bg-Gold" href="/games/">Games</a>
      </nav>

      <div class="bg-MidnightBlue text-BlanchedAlmond flex justify-center">
        <h1 class="p-1 text-4xl font-bold">Professional Football League</h1>
      </div>

    </header>

<!-- Header -->

    <main class="pt-2.5 pr-1 pb-2.5 pl-2.5 bg-LightBlue text-Navy flex flex-col">

<!-- Labels -->

      <div class="flex flex-row">
        <div class="m-1 text-xl font-bold basis-2/4 flex justify-start">        <h3>Manage Games</h3></div>
        <div class="m-1 text-xl font-bold basis-2/4 flex justify-start visible"><h3>Show Games</h3></div>
      </div>

<!-- Labels -->

      <div class="flex flex-row">

<!-- Column 1 -->

        <div class="m-1 bg-BurlyWood basis-2/4 flex justify-center">
          <div class="m-2.5 p-2.5 flex flex-column">

            <form action="/games/" method="post">
            @csrf

<!-- Text input 1 -->

              <div class="flex flex-row justify-start"> 
                <div class="mt-0 mr-0 mb-2.5 ml-0 bg-white border-2 border-solid border-Navy placeholder-Gray">
                  <input type="text" name="local" placeholder="Local" class="w-full">
                </div>
                <div class="pt-0 pr-0 pb-0 pl-1 text-red-500 font-bold">
                  @error('local') {{ $message }} @enderror
                  @if ($local !== false) {{ $local }} @endif
                </div>
              </div>

              <div class="flex flex-row justify-start"> 
                <div class="mt-0 mr-0 mb-2.5 ml-0 bg-white border-2 border-solid border-Navy placeholder-Gray">
                  <input type="text" name="visitor" placeholder="Visitor" class="w-full">
                </div>
                <div class="pt-0 pr-0 pb-0 pl-1 text-red-500 font-bold">
                  @error('visitor') {{ $message }} @enderror
                  @if ($visitor !== false) {{ $visitor }} @endif
                </div>
              </div>

              <div class="flex flex-row justify-start"> 
                <div class="mt-0 mr-0 mb-2.5 ml-0 bg-white border-2 border-solid border-Navy placeholder-Gray">
                  <input type="text" name="location" placeholder="Location" class="w-full">
                </div>
                <div class="pt-0 pr-0 pb-0 pl-1 text-red-500 font-bold">
                  @error('location') {{ $message }} @enderror
                </div>
              </div>

              <div class="flex flex-row justify-start"> 
                <div class="mt-0 mr-0 mb-2.5 ml-0 bg-white border-2 border-solid border-Navy placeholder-Gray">
                  <input type="text" name="dGame" placeholder="Date: yyyy-mm-dd hh:mm:ss" class="w-full">
                </div>
                <div class="pt-0 pr-0 pb-0 pl-1 text-red-500 font-bold">
                  @error('dGame') {{ $message }} @enderror
                </div>
              </div>

              <div class="flex flex-row justify-start"> 
                <div class="mt-0 mr-0 mb-2.5 ml-0 bg-white border-2 border-solid border-Navy placeholder-Gray">
                  <input type="text" name="L" placeholder="Local Score" class="w-full">
                </div>
                <div class="pt-0 pr-0 pb-0 pl-1 text-red-500 font-bold">
                  @error('L') {{ $message }} @enderror
                </div>
              </div>

              <div class="flex flex-row justify-start"> 
                <div class="mt-0 mr-0 mb-2.5 ml-0 bg-white border-2 border-solid border-Navy placeholder-Gray">
                  <input type="text" name="V" placeholder="Visitor Score" class="w-full">
                </div>
                <div class="pt-0 pr-0 pb-0 pl-1 text-red-500 font-bold">
                  @error('V') {{ $message }} @enderror
                </div>
              </div>

<!-- Text input 1 -->

<!-- Submit buttons -->

              <div class="w-48 m-1 border-none bg-Navy text-white text-center hover:bg-MediumBlue">
                <button type="submit" name="create" value="create" class="w-full">Create</button>
              </div>
              <div class="w-48 m-1 border-none bg-Navy text-white text-center hover:bg-MediumBlue">
                <button type="submit" name="update" value="update" class="w-full">Update</button>
              </div>
              <div class="w-48 m-1 border-none bg-Navy text-white text-center hover:bg-MediumBlue">
                <button type="submit" name="delete" value="detete" class="w-full">Delete</button>
              </div>
              <div class="w-48 m-1 border-none bg-Navy text-white text-center hover:bg-MediumBlue">
                <button type="submit" name="show" value="show" class="w-full">Show</button>
              </div>
              <div class="w-48 m-1 border-none bg-Navy text-white text-center hover:bg-MediumBlue">
                <button type="submit" name="all" value="all" class="w-full">All</button>
              </div>

<!-- Submit button 1 -->

            </form>

          </div>
        </div>

<!-- Column 1 -->

<!-- Column 2 -->

        <div class="m-1 bg-BurlyWood basis-2/4 flex visible w-full">
          <div class="m-1 p-1 flex flex-column self-start w-full">

            @if ($listing !== false)
              <table class="text-Navy"><tr>
                <th class="pr-2 pl-2">Local</th>
                <th class="pr-2 pl-2">Visitor</th>
                <th class="pr-2 pl-2">Location</th>
                <th class="pr-2 pl-2">Date</th>
                <th class="pr-2 pl-2">L</th>
                <th class="pr-2 pl-2">V</th></tr>
                  @foreach ($listing as $l)
                    <tr>
                      <td class="pr-2 pl-2"> {{ $l ['local'] }}    </td>
                      <td class="pr-2 pl-2"> {{ $l ['visitor'] }}    </td>
                      <td class="pr-2 pl-2"> {{ $l ['location'] }}  </td>
                      <td class="pr-2 pl-2"> {{ $l ['dGame'] }} </td>
                      <td class="pr-2 pl-2"> {{ $l ['L'] }}   </td>
                      <td class="pr-2 pl-2"> {{ $l ['V'] }}   </td>
                    </tr>
                  @endforeach
              </tr></table>
            @endif

          </div>
        </div>

<!-- Column 2 -->

      </div>
    </main>
  </body>
</html>

