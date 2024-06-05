<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Ameliya</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            padding: 50px 0;
            background-color: #2761e7;
            color: white;
        }
        .header h1 {
            margin: 0;
            font-size: 2.5em;
        }
        .section {
            margin: 50px 0;
        }
        .section h2 {
            border-bottom: 2px solid #2761e7;
            padding-bottom: 10px;
            color: #2761e7;
        }
        .section p {
            font-size: 1.2em;
            line-height: 1.6;
        }
        .team {
            display: flex;
            justify-content: space-around;
            margin: 50px 0;
        }
        .team-member {
            text-align: center;
        }
        .team-member img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
        }
        .team-member h3 {
            margin-top: 10px;
            color: #2761e7;
        }
        .contact-form {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .contact-form h2 {
            margin-top: 0;
        }
        .contact-form label {
            display: block;
            margin: 15px 0 5px;
        }
        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .contact-form input[type="submit"] {
            background-color: #2761e7;
            color: white;
            border: none;
            cursor: pointer;
            padding: 15px 20px;
            border-radius: 4px;
            font-size: 1em;
        }
        .contact-form input[type="submit"]:hover {
            background-color: #164a8c;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Welcome to Ameliya</h1>
        <p>Where fashion meets elegance and style</p>
    </div>
    <div class="container">
        <div class="section">
            <h2>Our Story</h2>
            <p>Founded by the visionary Amasha Charthurni, Ameliya is more than just a clothing brand; it's a celebration of individuality, creativity, and timeless beauty. Our mission is to provide high-quality, stylish clothing that empowers women to feel confident and express their unique personalities.</p>
        </div>
        <div class="section">
            <h2>Our Values</h2>
            <p>At Ameliya, we believe in:</p>
            <ul>
                <li>Quality: Every piece of clothing is crafted with the finest materials and utmost care.</li>
                <li>Elegance: Our designs are timeless, aiming to enhance the natural beauty of every woman.</li>
                <li>Individuality: We celebrate the uniqueness of every customer, offering styles that allow for personal expression.</li>
                <li>Sustainability: We are committed to environmentally friendly practices and ethical production processes.</li>
            </ul>
        </div>
        <div class="section team">
            <div class="team-member">
              
                <h3>Amasha Charthurni</h3>
                <p>Founder & Creative Director</p>
            </div>
            <div class="team-member">
                
                <h3>Kavitha Kanchana</h3>
                <p>Site Developer</p>
            </div>
        </div>
        <div class="section contact-form">
            <h2>Contact Us</h2>
            <form action="/submit_contact_form" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="4" required></textarea>

                <input type="submit" value="Submit">
            </form>
        </div>
    </div>
</body>
</html>
