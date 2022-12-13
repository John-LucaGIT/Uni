package game;

import city.cs.engine.*;


public class Shrek extends Walker {
        private static final Shape shrekShape = new PolygonShape(
                -1.11f,-2.34f, 0.61f,-2.05f, 1.27f,1.01f, -0.76f,2.46f, -1.22f,-0.03f, -1.15f,-2.1f);
        // add image to shrek
        private static BodyImage image;
        // getter for image
        public static BodyImage getImage() {
            return image;
        }
        // fields for health and donkey count
        private static int donkeyCount;
        private static int healthCount;
        // field for highscore
        private static int highscore;
        // getter for highscore
        public static int getHighscore() {
            return highscore;
        }
        // setter for highscore
        public static void setHighscore(int highscore) {
        Shrek.highscore = highscore;
        }
        // getter for donkey count
        public static int getDonkeyCount(){
            return donkeyCount;
        }
        // add donkey method
        public void addDonkey(){
            donkeyCount++;
        }
        // remove donkey method
        public static void removeDonkey(){
            donkeyCount--;
            System.out.println("You shot, donkey count: "+ donkeyCount);
        }
        public static int getHealthCount(){
            return healthCount;
        }
        // create setter for donkeycount
        public static void setDonkeyCount(int donkeyCount) {
        Shrek.donkeyCount = donkeyCount;
        }
        // create setter for healthCount
        public static void setHealthCount(int healthCount) {
        Shrek.healthCount = healthCount;
    }

    // method for losing life
    public void subLife(){
            if(healthCount >= 1) {
                healthCount--;
                System.out.println("You lost a life moron, lives left: "+ healthCount);
            }
            else if(healthCount == 0) {
                destroy();
                try{
                    Sounds.getRoarSound().play();
                }catch (NullPointerException nullPointerException){ // if death sound cannot be found continue without sound and print error msg
                    System.out.println("Could not find death sound continuing to die without sound");
                }
                System.out.println("Game Over!");
            }
        }
        // method for Shrek to die
        private static boolean shrekdead = false; // boolean set to determine if shrek dead method has run
        public void shrekDie(){
            if (shrekdead != true){
                shrekdead = true;
                healthCount = 0;
                destroy();
                try{
                    Sounds.getRoarSound().play();
                }catch (NullPointerException nullPointerException){ // if death sound cannot be found continue without sound and print error msg
                    System.out.println("Could not find death sound continuing to die without sound");
                }
                System.out.println("Game Over!");
            }
        }
        public Shrek(World world) {
            super(world, shrekShape);
            donkeyCount = 0;
            healthCount = 1;
            try{
                image = new BodyImage("data/shrek.png", 5f);
                addImage(image);
            }catch (Exception e){ // in case image cannot be found print image not found and exit game
                System.out.println("Image not found, please replace image");
                System.exit(0);
            }
        }
}