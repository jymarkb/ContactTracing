package com.example.qrcodescanner.Common.signup;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.AutoCompleteTextView;
import android.widget.Button;
import android.widget.ImageView;

import com.example.qrcodescanner.Common.login.login;
import com.example.qrcodescanner.R;
import com.google.android.material.textfield.TextInputLayout;


public class signup_first_form extends AppCompatActivity {

    private long backPressTime;

    private TextInputLayout txtInputV_dropdown_brgy, txtInputV_dropdown_zone;
    private AutoCompleteTextView autoV_dropdown_brgy, autoV_dropdown_zone;

    Button btnVLogin, btnSignUpNext;
    ImageView imgVSignUpBack;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_signup_first_form);

        txtInputV_dropdown_brgy = findViewById(R.id.dropdown_brgy);
        autoV_dropdown_brgy = findViewById(R.id.autoComplete_brgy);
        txtInputV_dropdown_zone = findViewById(R.id.dropdown_zone);
        autoV_dropdown_zone = findViewById(R.id.autoComplete_zone);

        btnVLogin = findViewById(R.id.btnLogin);
        imgVSignUpBack = findViewById(R.id.btnImgSignUpBack);
        btnSignUpNext = findViewById(R.id.btnSignUpNext);

        btnVLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                getLogin();
            }
        });
        imgVSignUpBack.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                getLogin();
            }
        });
        btnSignUpNext.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                getNext();
            }
        });

        String [] brgy = new String[]{"Barangay 1", "Barangay 2", "Barangay 3", "Barangay 4"};

        String [] zone = new String[]{"Zone 1", "Zone 2", "Zone 3", "Zone 4", "Zone 5", "Zone 6", "Zone 7"};

        ArrayAdapter<String> brgyAdapter = new ArrayAdapter<>(signup_first_form.this, R.layout.dropdown_item,brgy);
        autoV_dropdown_brgy.setAdapter(brgyAdapter);

        ArrayAdapter<String> zoneAdapter = new ArrayAdapter<>(signup_first_form.this, R.layout.dropdown_item,zone);
        autoV_dropdown_zone.setAdapter(zoneAdapter);


    }

    public void getLogin(){
        Intent intent = new Intent(signup_first_form.this, login.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK| Intent.FLAG_ACTIVITY_NEW_TASK);
        signup_first_form.this.startActivity(intent);
    }


    public void getNext() {
        Intent intent = new Intent(signup_first_form.this, signup_second_form.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK| Intent.FLAG_ACTIVITY_NEW_TASK);
        signup_first_form.this.startActivity(intent);
    }

    @Override
    public void onBackPressed() {
        if (backPressTime + 2000 > System.currentTimeMillis()){
            super.onBackPressed();
            return;
        }else{
            getLogin();
        }
        backPressTime = System.currentTimeMillis();
    }


}