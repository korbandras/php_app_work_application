<html>
<head>
    <link rel = "stylesheet" href = "../css_files/head.css">
    <link rel = "stylesheet" href = "../css_files/basic.css">
    <title>Advertisements Page</title>
</head>
    <body>
        <header class = "header">
            <div class = "left">
                <a class = "homeleft" href = "Users_page.php">Users</a>
            </div>
            <div class = "middle">
                <h2>Created by Andras Korb</h2>
            </div>
            <div class = "right">
                <a class = "homeright" href = "Advertisements_page.php">Advertisements</a>
            </div>
        </header>
        <table class = "hometablee">
            <tr>
                <td><h4>Requirements</h4></td>
                <td><h4>Objective</h4></td>
            </tr>
            <tr>
                <td class = "hometable">
                    <ul>
                        <li>The application should have 2 database tables: users (id, name) and
                            advertisements (id, userid, title).</li>
                        <li>As a user I'd like a page that shows the list of the users existing in
                            the system.</li>
                        <li>As a user I'd like a page that shows the list of the existing
                        advertisements in the system (and the related user's name of course)</li>
                        <li>They should be different pages</li>
                        <li>So the system should contain 3 pages:</li>
                        <ul>
                        <li>-> index, with the links to the user list and the advertisement list</li>
                        <li>-> user list</li>
                        <li>-> advertisement list</li>
                        <li>-> The whole system should have a minimalist design (css)</li>
                        </ul>
                    </ul>
                </td>
                <td class = "hometable">
                    <p>So it's a 3 paged application, with a minimal design, and database access,
                    which is URL mapped, and based on an MVC pattern. No framework or CMS
                    allowed to use.
                    <p>I need the source of the application, which I expect to be about 6-8 files.
                    Here can be a difference of course.
                    <p>Requirements regarding the implementation:</p>
                    <ul>
                        <li> Must be object oriented!</li>
                        <li> Must have at least 1 layer under the Controller layer</li>
                        <li> Model and service methods should be separated. Model here should be
                        clear, used only for representation.</li>
                        <li> Must have a nice, and well documented code</li>
                        <li>A very simple css, in minimal style</li>
                    </ul>

                </td>
            </tr>
        </table>
    </body>
</html>
