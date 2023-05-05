package com.example.mytivi;

import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.widget.VideoView;

import androidx.fragment.app.FragmentActivity;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.net.MalformedURLException;
import java.net.URL;

/*
 * Main Activity class that loads {@link MainFragment}.
 */
public class MainActivity extends FragmentActivity{

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        try {
            getData( );
        } catch (MalformedURLException e) {
            throw new RuntimeException(e);
        }

        if (savedInstanceState == null) {
            getSupportFragmentManager().beginTransaction()
                    .replace(R.id.main_browse_fragment, new MainFragment())
                    .commitNow();
        }
    }
    public void getData( ) throws MalformedURLException {
        Uri uri= Uri.parse("10.168.2.96")
                .buildUpon().build();
        URL url=new URL(uri.toString());
        new DoTask().execute(url);
    }
    class DoTask extends AsyncTask<URL, Void, String>{

        @Override
        protected String doInBackground(URL... urls) {
            URL url=urls [0];
            String data=null;
            try{
                data=Ketnoi.makeHTTPRequest(url);
            }
            catch (IOException e){
                e.printStackTrace();
            }
            return data;
        }
        @Override
        protected void onPostExecute(String s){
            try {
                parseJson(s);
            } catch (JSONException e) {
                throw new RuntimeException(e);
            }
        }
        public void parseJson(String data) throws JSONException {
            JSONObject jsonObject=null;
            try{
                jsonObject=new JSONObject(data);
            }catch (JSONException e){
                e.printStackTrace();
            }
            JSONArray videoArray=jsonObject.getJSONArray("data");
            for(int i=0; i<videoArray.length();i++){
                JSONObject video=videoArray.getJSONObject(i);
                String vd=video.get("video").toString();
                final VideoView videoView=(VideoView) findViewById(R.id.videoView);
                videoView.setVideoPath(vd);
                videoView.start();

            }

        }

    }

}