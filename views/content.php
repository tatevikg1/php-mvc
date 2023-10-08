
<div class="row " >
    <div class="col" style="margin-top:70px">
        <h3>Modern PHP Without a Framework</h3>

        <small>Kevin Smith · Mar 20, 2018 @ 8:29am</small>
        <p>
            I've got a challenge for you. The next time you start a new project, try not using a PHP framework
        </p>
        <p>
            Now, this isn't an anti-framework screed. Neither is it a promotion of not-invented-here thinking. After all, we're going to be using some packages written by several framework developers in this tutorial. I've got nothing but great respect for the innovation going on in that space.
        </p>
        <p>
            This isn't about them. This is about you. It's about giving yourself the opportunity to grow as a developer.
        </p>
        <p>
            Perhaps the biggest benefit you'll find working without a framework is the wealth of knowledge about what's going on under the hood. You get to see exactly what's happening without relying on the framework's magic to take care of things for you in a way that you can't debug and don't really understand.
        </p>
        <p>
            It's quite possible your next job will not grant the luxury of starting a greenfield project with your framework of choice. The reality is that most high-value, business-critical PHP jobs involve existing applications. And whether that application is built in a framework currently enjoying popular support like Laravel or Symfony, a framework from days gone by like CodeIgniter or FuelPHP, or even the depressingly widespread legacy PHP application employing an "include-oriented architecture", building without a framework now will better prepare you to take on any PHP project in the future.
        </p>
        <p>
            In the past, it was an uphill battle to build without a framework because some kind of system had to interpret and route HTTP requests, send HTTP responses, and manage dependencies. The lack of industry standards necessarily meant that, at the very least, those components of a framework were tightly coupled. If you didn't start with a framework, you'd end up building one yourself.
        </p>
        <p>
            But today, thanks to all the autoload and interoperability work done by PHP-FIG, building without a framework doesn't mean building it all by yourself. There are so many excellent, interoperable packages from a wide range of vendors. Pulling it all together is easier than you think!
        </p>
    </div>
    <div class="col" style="margin-top:70px">
        <h3>PHP, How Does it Work? </h3>
        <p>
            Before we get into anything else, it's important to understand how PHP applications interact with the outside world.
        </p>
        <p>
            PHP runs server-side applications in a request/response cycle. Every interaction with your app—whether it's from the browser, the command line, or a REST API—comes into the app as a request. When that request is received, the app is booted up, it processes the request to generate a response, the response is emitted back to the client that made the request, and the app shuts down. That happens with every interaction.
        </p>
        <h3>The Front Controller </h3>
        <p>
            Armed with that knowledge, we'll kick things off with the front controller. The front controller is the PHP file that handles every request for your app. It's the first PHP file a request hits on its way into your app, and (essentially) the last PHP file a response runs through on its way out of your app.
        </p>
        <p>
            Let's use the classic Hello, world! example served up by PHP's built-in web server just to make sure we've got everything wired up correctly. If you haven't already done so, be sure you have PHP 7.2 or newer installed in your environment.
        </p>
        <p>
            Create a project directory with a public directory in it, and then inside it create index.php with the following code.
        </p>
        <p>
            Note that we're declaring strict typing here—which is something you should do at the top of every PHP file in your app—because type hints are important for debugging and clearly communicating intent to developers that come behind you.
        </p>
        <p>
            Navigate to your project directory using a command-line tool (like Terminal on macOS) and start PHP's built-in web server.
        </p>
    </div>

    <div class="container">
        <h3>Autoload and Third-Party Packages </h3>
        <p>
            When you first started with PHP, you may have used includes or requires statements throughout your app to bring in functionality or configuration from other PHP files. In general, we want to avoid that because it makes it much harder for a human to follow the code path and understand where dependencies lie. That makes debugging a real nightmare.
        </p>
        <p>
            The solution is autoload. Autoload just means that when your application needs to use a class, PHP knows where to look for it and automatically loads it when it's called for. It's been available since PHP 5, but its usage really started picking up steam with the introduction of PSR-0 (the autoload standard that has since been superseded by PSR-4).
        </p>
        <p>
            We could go through the rigamarole of writing our own autoloader, but since we're going to use Composer to manage third-party dependencies and it already includes a perfectly serviceable autoloader, let's just use that one.
        </p>
        <p>
            Make sure you've got Composer installed on your system. Then setup Composer for this project.
        </p>
    </div>
