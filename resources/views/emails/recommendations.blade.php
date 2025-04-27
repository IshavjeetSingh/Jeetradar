<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Your Travel Recommendations from RoamRadar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px 0;
            background-color: #3498db;
            color: white;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .search-criteria {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 30px;
        }
        .search-criteria h2 {
            color: #3498db;
            margin-top: 0;
            font-size: 18px;
        }
        .destination {
            margin-bottom: 30px;
            border: 1px solid #eee;
            border-radius: 5px;
            overflow: hidden;
        }
        .destination-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .destination-content {
            padding: 15px;
        }
        .destination h3 {
            color: #3498db;
            margin-top: 0;
        }
        .tags {
            margin-top: 10px;
        }
        .tag {
            display: inline-block;
            background-color: #e9f7fe;
            color: #3498db;
            padding: 3px 8px;
            border-radius: 3px;
            margin-right: 5px;
            font-size: 12px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
        .button {
            display: inline-block;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Your Travel Recommendations from RoamRadar</h1>
        </div>

        <p>Hello,</p>
        <p>Thank you for using RoamRadar to find your perfect travel destination. Below are your personalized recommendations based on your preferences.</p>

        <div class="search-criteria">
            <h2>Your Search Criteria</h2>
            <p><strong>Budget:</strong> ${{ number_format($budget, 2) }}</p>
            <p><strong>Travel Dates:</strong> {{ date('F j, Y', strtotime($startDate)) }} - {{ date('F j, Y', strtotime($endDate)) }}</p>
            <p><strong>Selected Activities:</strong> {{ implode(', ', array_map('ucfirst', $activities)) }}</p>
        </div>

        <h2>Recommended Destinations</h2>

        @if(count($destinations) > 0)
            @foreach($destinations as $destination)
                <div class="destination">
                    <img src="{{ $destination['image'] }}" alt="{{ $destination['name'] }}" class="destination-image">
                    <div class="destination-content">
                        <h3>{{ $destination['name'] }}</h3>
                        <p>{{ $destination['description'] }}</p>
                        <p><strong>Estimated Cost:</strong> ${{ number_format($destination['cost'], 2) }}</p>
                        
                        <div class="tags">
                            @foreach($destination['tags'] as $tag)
                                <span class="tag">{{ ucfirst($tag) }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>No destinations found matching your criteria. Try adjusting your budget or selecting different activities.</p>
        @endif

        <div style="text-align: center;">
            <a href="{{ url('/recommend') }}" class="button">Find More Destinations</a>
        </div>

        <div class="footer">
            <p>This email was sent from RoamRadar. If you did not request these recommendations, please ignore this email.</p>
            <p>&copy; {{ date('Y') }} RoamRadar. All rights reserved.</p>
        </div>
    </div>
</body>
</html> 