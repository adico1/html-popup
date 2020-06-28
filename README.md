# STARTING THE SERVER

./start-server.sh

will download apache with php and run the docker using the current folder as the volume.

# PREVIEW THE FILES

Open the browser and type in the following Urls:

http://localhost:8080/html-with-popup.html

That Url provides the same inteface but communicates with a static JSON api.

http://localhost:8080/html-with-popup-to-php.html

That Url provides the same inteface but communicates with the PHP api.

*NOTE:* The interface is the interface as required by the home assignment:
- popup triggered by button
- popup data is fetched from an API
- overlay is displayed with popup