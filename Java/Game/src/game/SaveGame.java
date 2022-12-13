package game;

import java.io.BufferedReader;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;

public class SaveGame {

    /**
     * SaveGame and Load game methods for 1. highscore and 2. loading and saving games.
     * Most everything is surrounded with try catch in order to avoid the game from crashing,
     * only important information is saved and to simplify my code I have created a reset method through the load file method.**/

    public static void save(GameWorld world, String fileName)
    throws IOException{
        boolean append = false;
        FileWriter writer = null;
        try{
            writer = new FileWriter(fileName,append); // create writer
            writer.write(world.getGameWorldName()+","+Shrek.getDonkeyCount()+","+Shrek.getHealthCount()+","+Wizzard.getHealthCount()+","+Mike.getHealthCount()+"\n"); // set variables to be written
        } finally{
            if (writer != null){
                writer.close();
            }
        }
    }
    public static void highscore(GameWorld world,String fileName)
        throws IOException{
        boolean append2 = false;
        FileWriter writer2 = null;
        try{
            writer2 = new FileWriter(fileName,append2); // create writer
            writer2.write(Tracker.getScore()+"\n"); // set variables to be written
        } finally{
            if (writer2 != null){
                writer2.close();
            }
        }
    }
    public static GameWorld load(Game game,String fileName)
    throws IOException
    {
        FileReader fr = null;
        BufferedReader reader = null;
        try{
            System.out.println("Reading "+fileName+"...");
            fr = new FileReader(fileName);
            reader = new BufferedReader(fr);
            String line = reader.readLine(); // reader set to readline()
            String[] tokens = line.split(","); // items in the array are split by a comma
            String name = tokens[0]; // field name is set to item 0 in array for level name
            int donkeyCount = Integer.parseInt(tokens[1]); // select item 1 from array for donkey count
            int healthCount = Integer.parseInt(tokens[2]); // select item 2 from array for healthcount
            int wizzardHealthCount = Integer.parseInt(tokens[3]); // select item 3 from array to update wizzardhealthcount
            int mikeHealthCount = Integer.parseInt(tokens[4]); // select item 4 from array to update mikehealthcount
            GameWorld world = null; // set world to null
            if (name.equals("Level 1")) { // if first item String in array matches Level 1 then set level to one and update int level counter
                Game.setLevelInt(1);
                world = new Level1(game);
            }
            else if (name.equals("Level 2")) { // if first item String in array matches Level 2 then set level to one and update int level counter
                Game.setLevelInt(2);
                world = new Level2(game);
            }
            else if (name.equals("Level 3")) { // if first item String in array matches Level 3 then set level to one and update int level counter
                Game.setLevelInt(3);
                world = new Level3(game);
            }
            else if (name.equals("Level 4")){ // if first item String in array matches Level 4 then set level to one and update int level counter and update music
                Game.setLevelInt(4);
                world = new Level4(game);
                try{
                    Sounds.getBackgroundMusic().stop(); // stop old background music
                    Sounds.getGravityFallsMusic().play(); // start new music
                    Sounds.getGravityFallsMusic().loop(); // loop music
                    Game.setplaying("finalmusic");
                }catch (Exception e){
                    System.out.println("file not found"); // add file not found exception output
                }

            }
            Shrek.setDonkeyCount(donkeyCount); // update donkeys
            Wizzard.setHealthCount(wizzardHealthCount); // update wizzard health
            Mike.setHealthCount(mikeHealthCount); // update mike health
            Shrek.setHealthCount(healthCount); // update shrek health
            return world;
        } finally{
            if (reader != null){
                reader.close();
            }
            if (fr != null){
                fr.close();
            }
        }
    }
    public static int loadscore(Game game,String fileName)
            throws IOException
    {
        FileReader fr = null;
        BufferedReader reader = null;
        try{
            System.out.println("Reading "+fileName+"...");
            fr = new FileReader(fileName);
            reader = new BufferedReader(fr);
            String line = reader.readLine(); // reader set to readline()
            String[] tokens = line.split(","); // items in the array are split by a comma
            int saveScore = Integer.parseInt(tokens[0]); // select item 0 in array and add to saveScore
            Shrek.setHighscore(saveScore); // update score
            return saveScore;
        } finally{
            if (reader != null){
                reader.close();
            }
            if (fr != null){
                fr.close();
            }
        }
    }
}

