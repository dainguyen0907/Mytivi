package com.example.myapplication;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.media.MediaPlayer;
import android.os.Bundle;
import android.os.Handler;
import android.widget.TextView;
import android.widget.VideoView;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.Locale;

public class MainActivity extends AppCompatActivity {

    private RequestQueue requestQueue;
    private final Handler handler = new Handler();
    private Runnable refresh;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        requestQueue = Volley.newRequestQueue(this);

        getData();

    }

    public void getData()
    {
        String url="https://res.cloudinary.com/dj34wz5m9/raw/upload/v1684823586/Video/generated_1_adx2sr.json";
        JsonObjectRequest jsonObjectRequest=new JsonObjectRequest(Request.Method.GET, url, null, new Response.Listener<JSONObject>() {
            @Override
            public void onResponse(JSONObject response) {
                try {
                    JSONArray jsonArray=response.getJSONArray("schedule");
                    for (int i = 0; i < jsonArray.length(); i++) {
                        JSONObject video = jsonArray.getJSONObject(i);

                        String time_Start = video.get("time_start").toString();
                        String time_End = video.get("time_end").toString();

                        Date time = Calendar.getInstance().getTime();
                        SimpleDateFormat timeFormat = new SimpleDateFormat("HH:mm", Locale.getDefault());
                        String Time = timeFormat.format(time);

                        if (time_Start.compareTo(Time) <= 0) {

                            Date date1=null;
                            Date date2=null;
                            try {
                                date1=timeFormat.parse(time_Start);
                                date2=timeFormat.parse(time_End);
                            }catch (ParseException e) {
                                e.printStackTrace();
                            }
                            Calendar calendar1 = Calendar.getInstance();
                            Calendar calendar2 = Calendar.getInstance();
                            calendar1.setTime(date1);
                            calendar2.setTime(date2);
                            long delay = calendar2.getTimeInMillis()-calendar1.getTimeInMillis();

                            refresh=new Runnable() {
                                @Override
                                public void run() {
                                    Intent intent = getIntent();
                                    overridePendingTransition(0, 0);
                                    intent.addFlags(Intent.FLAG_ACTIVITY_NO_ANIMATION);
                                    finish();
                                    overridePendingTransition(0, 0);
                                    startActivity(intent);
                                    handler.postDelayed(this,delay);
                                }
                            };
                            handler.postDelayed(refresh, delay);

                            String vd = video.get("link_program").toString();
                            final VideoView videoView = (VideoView) findViewById(R.id.videoView);
                            videoView.setVideoPath(vd);
                            videoView.start();
                            videoView.setOnPreparedListener(new MediaPlayer.OnPreparedListener() {
                                @Override
                                public void onPrepared(MediaPlayer mp) {

                                    mp.setLooping(true);
                                }
                            });
                        }//else{
                        //}
                    }
                } catch (JSONException e) {
                    throw new RuntimeException(e);
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                error.printStackTrace();
            }
        });
        requestQueue.add(jsonObjectRequest);
    }
}