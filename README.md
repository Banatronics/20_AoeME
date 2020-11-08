# 20_AoeME
Age Of Empires - Map Editor
Steps to create new maps for Age of Empires 2 edition (scx scenarios compatible also with AOE2HD)
1. Open a map in google maps
2. Take a scree shot of the desired area
3. Open the image in mspaint
4. Resize image to 240x240 pixels
5. Save it in BMP 16 colors format (16 indexed colors)
6. Modify image to your desire (use color codes and associated terrains/units from ColorCodes.docx)
 6.1 If too many pixels need to be modified, an automatic way to beautify the image is using the ImgFormat.php subtool)
7. Open bmp with GIMP
8. Flip image vertically
9. Rotate it with 90 deg clockwise
10. Export it as a *.PNG
11. Update scenario.php with the path to your new *.png
12. Run within wamp server, compiler.php twice
