# 20_AoeME
Age Of Empires - Map Editor
Steps to create new maps for Age of Empires 2 edition (scx scenarios compatible also with AOE2HD)
1. Open a map in google maps
2. Take a scree shot of the desired area
3. Open the image in mspaint
4. Save it in BMP 16 colors format (16 indexed colors)
5. Modify image to your desire (use color codes and associated terrains/units from ColorCodes.docx)
 5.1 If too many pixels need to be modified, an automatic way to beautify the image is using the ImgFormat.php subtool)
6. Open bmp with GIMP
7. Flip image vertically
8. Rotate it with 90 deg clockwise
9. Export it as a *.PNG
10. Update scenario.php with the path to your new *.png
11. Run within wamp server, compiler.php twice
