package com.example.qrcodescanner.Common;

import android.app.ActivityOptions;
import android.content.Context;
import android.content.Intent;
import android.util.Pair;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.viewpager.widget.PagerAdapter;

import com.example.qrcodescanner.Common.login.login;
import com.example.qrcodescanner.MainActivity;
import com.example.qrcodescanner.R;

public class SplashViewPagerAdapter extends PagerAdapter {

    Context ctx;

    public SplashViewPagerAdapter(Context ctx) {
        this.ctx = ctx;
    }

    @Override
    public int getCount() {
        return 3;
    }

    @Override
    public boolean isViewFromObject(@NonNull View view, @NonNull Object object) {
        return view == object;
    }

    @NonNull
    @Override
    public Object instantiateItem(@NonNull ViewGroup container, final int position) {
        LayoutInflater layoutInflater = (LayoutInflater) ctx.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        View view = layoutInflater.inflate(R.layout.first_splash_screen, container, false);

        ImageView banner = view.findViewById(R.id.imgLogo);
        final ImageView indicator1 = view.findViewById(R.id.imgSplashIndicator1);
        final ImageView indicator2 = view.findViewById(R.id.imgSplashIndicator2);
        final ImageView indicator3 = view.findViewById(R.id.imgSplashIndicator3);

        TextView title = view.findViewById(R.id.txtSplashTitle);
        TextView description = view.findViewById(R.id.txtSplashDescription);

        final Button start = view.findViewById(R.id.btnStarted);

        final Button next = view.findViewById(R.id.btnNext);
        final Button skip = view.findViewById(R.id.btnSkip);


        start.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(ctx, login.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK | Intent.FLAG_ACTIVITY_NEW_TASK);
                ctx.startActivity(intent);
            }
        });

        skip.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(ctx, login.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK | Intent.FLAG_ACTIVITY_NEW_TASK);
                ctx.startActivity(intent);
            }
        });


        next.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Splash.viewPager.setCurrentItem(position + 1);

            }
        });


        switch (position) {
            case 0:
                banner.setImageResource(R.drawable.banner4);
                indicator1.setImageResource(R.drawable.selected);
                indicator2.setImageResource(R.drawable.unselected);
                indicator3.setImageResource(R.drawable.unselected);
                title.setText("COVID - 19 Libmanan Contact Tracing");
                description.setText("A Municipality of Libmanan Contact Tracing App \n Cooperation is the to fight the pandemic Covid-19");
                start.setVisibility(View.INVISIBLE);
                break;

            case 1:
                banner.setImageResource(R.drawable.banner2);
                indicator1.setImageResource(R.drawable.unselected);
                indicator2.setImageResource(R.drawable.selected);
                indicator3.setImageResource(R.drawable.unselected);

                title.setText("Libmanan Contact Tracing QR Code Scanner App");
                description.setText("This app will utilize the QR Code technology by scanning the identification card of the citizen & visitors entering the establishment in the town of Libmanan");
                start.setVisibility(View.INVISIBLE);
                break;

            case 2:
                banner.setImageResource(R.drawable.banner3);
                indicator1.setImageResource(R.drawable.unselected);
                indicator2.setImageResource(R.drawable.unselected);
                indicator3.setImageResource(R.drawable.selected);

                title.setText("Start Scanning the Identification Card");
                description.setText("By scanning the identification card of the citizens & visitors, you can now contribute in the community contact tracing on the town of Libmanan");
                next.setVisibility(View.INVISIBLE);
                skip.setVisibility(View.INVISIBLE);
                start.setVisibility(View.VISIBLE);
                break;
        }


        container.addView(view);
        return view;
    }

    @Override
    public void destroyItem(@NonNull ViewGroup container, int position, @NonNull Object object) {
        container.removeView((View) object);
    }
}
