package com.example.qrcodescanner.Scanner;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import com.budiyev.android.codescanner.CodeScanner;
import com.budiyev.android.codescanner.CodeScannerView;
import com.budiyev.android.codescanner.DecodeCallback;
import com.example.qrcodescanner.MainActivity;
import com.example.qrcodescanner.R;
import com.google.zxing.Result;

public class scanner_out extends AppCompatActivity {

    CodeScanner codeScanner;
    CodeScannerView scannerView;

    Button btnVback;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_scanner_out);

        btnVback = findViewById(R.id.btnScannerBack);

        scannerView = findViewById(R.id.scanner_view_out);
        codeScanner = new CodeScanner(this, scannerView);
        codeScanner.startPreview();
        codeScanner.setDecodeCallback(new DecodeCallback() {
            @Override
            public void onDecoded(@NonNull final Result result) {
                runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
                        if (!result.getText().equals("")){
                            Intent intent = new Intent(scanner_out.this, scanner_alert_out.class);
                            intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK| Intent.FLAG_ACTIVITY_NEW_TASK);
                            scanner_out.this.startActivity(intent);
                        }
//                        Toast.makeText(scanner_out.this, result.getText(), Toast.LENGTH_SHORT).show();
                    }
                });
            }
        });

        btnVback.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                getHome();
            }
        });
    }

    @Override
    public void onBackPressed() {
        getHome();
    }

    public  void getHome(){
        Intent intent = new Intent(scanner_out.this, MainActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK| Intent.FLAG_ACTIVITY_NEW_TASK);
        scanner_out.this.startActivity(intent);
    }
}