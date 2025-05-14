package com.example.qrcodescanner.admin;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageView;

import com.example.qrcodescanner.Common.login.login;
import com.example.qrcodescanner.Common.signup.signup_first_form;
import com.example.qrcodescanner.MainActivity;
import com.example.qrcodescanner.R;

public class user_history extends AppCompatActivity {

    private long backPressTime;

    ImageView imgVback;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_user_history);

        imgVback = findViewById(R.id.history_back);


        imgVback.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                getMain();
            }
        });

    }

    @Override
    public void onBackPressed() {
        if (backPressTime + 2000 > System.currentTimeMillis()){
            super.onBackPressed();
            return;
        }else{
            getMain();
        }
        backPressTime = System.currentTimeMillis();
    }

    public void getMain(){
        Intent intent = new Intent(user_history.this, MainActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK| Intent.FLAG_ACTIVITY_NEW_TASK);
        user_history.this.startActivity(intent);
    }
}