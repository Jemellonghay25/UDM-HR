
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Information System</title>
    <link rel="shortcut icon" href="img/ui/favicon.ico"/>
    <link rel="stylesheet" href="css/bulma/css/versions/bulma-no-dark-mode.min.css">
    <link rel="stylesheet" href="css/override.css">
    <script src="https://kit.fontawesome.com/1b039bb504.js" crossorigin="anonymous"></script>
    <script src="js/ajax.login.js" defer></script>
</head>
<body>    
    <div class="hero is-fullheight">
        <nav class="navbar has-shadow" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a id="navLog" class="navbar-item"> <!-- possible way to refresh page once click -->
                    <figure class="image is-48x48">
                        <img src="img/ui/udm-logo-1.png" alt="udm logo">
                    </figure>
                    <h1 class="is-size-5 ml-3">HR Information System</h1>
                </a>
            </div>
        </nav>
        <div class="columns">
            <div class="column is-4"></div>
            <div class="column is-4">
                <div class="box">
                    <form id="lgn_frm" class=" pl-5 pr-5">
                        <div class="field">
                            <p class="control has-icons-left has-icons-right">
                                <input id="username" class="input" placeholder="Username" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-user"></i>
                                </span>
                            </p>
                        </div>
                        <div class="field">
                            <p class="control has-icons-left">
                                <input id="password" class="input" type="password" placeholder="Password" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </p>
                        </div>
                        <div>
                            <p class="has-text-danger pb-3" id="lgn_rspns"></p>
                        </div>
                        <div class="field">
                            <p class="control">
                                <button id="lgn_btn" class="button is-success " type="submit">
                                    Submit
                                </button>
                            </p>
                        </div>  
                    </form> 
                </div>  
            <div class="column is-4"></div>
        </div>
        </div>
        <!-- <footer class="footer">
            <div class="content has-text-centered is-italic">
               
            </div>
        </footer> -->
    </div>
</body>
</html>