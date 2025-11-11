# TwoFlip.com - E-commerce Platform

A complete solution for E-commerce Business with exclusive features & super responsive layout built with Laravel.

## 🚀 Features

- **Multi-vendor Marketplace**: Support for multiple sellers and vendors
- **Auction System**: Bidding functionality for products
- **Wholesale Management**: Bulk pricing and wholesale features
- **Customer Management**: Complete customer registration and profile management
- **Order Management**: Comprehensive order tracking and management
- **Payment Gateways**: Multiple payment options including:
  - PayPal
  - Stripe
  - Razorpay
  - Paystack
  - Flutterwave
  - Bkash
  - Nagad
  - And many more
- **Multi-language Support**: Internationalization ready
- **Multi-currency Support**: Support for multiple currencies
- **SEO Optimized**: Search engine friendly URLs and meta tags
- **Mobile Responsive**: Fully responsive design
- **Admin Dashboard**: Comprehensive admin panel
- **Seller Dashboard**: Dedicated seller management panel
- **Blog System**: Built-in blog functionality
- **Coupon System**: Discount and promotional codes
- **Affiliate System**: Affiliate marketing support
- **Push Notifications**: Real-time notifications
- **SMS Integration**: SMS notifications support
- **Email Templates**: Customizable email templates
- **File Upload**: Advanced file upload system
- **Social Login**: Login with Google, Facebook, etc.

## 🛠️ Tech Stack

- **Framework**: Laravel 8+
- **Database**: MySQL
- **Frontend**: Bootstrap 4, jQuery
- **CSS**: SASS
- **JavaScript**: ES6+
- **Package Manager**: Composer, NPM

## 📋 Requirements

- PHP >= 7.4
- MySQL >= 5.7
- Composer
- Node.js & NPM
- Web Server (Apache/Nginx)

## 🔧 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yasirraheel/edit.twoflip.com.git
   cd edit.twoflip.com
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Environment Setup**
   ```bash
   cp .env.example .env
   ```
   
5. **Configure your `.env` file** with your database and other settings:
   ```env
   APP_NAME="TwoFlip.com"
   APP_ENV=production
   APP_KEY=your-app-key
   APP_DEBUG=false
   APP_URL=https://yourdomain.com
   
   DB_CONNECTION=mysql
   DB_HOST=your-db-host
   DB_PORT=3306
   DB_DATABASE=your-database-name
   DB_USERNAME=your-db-username
   DB_PASSWORD=your-db-password
   ```

6. **Generate application key**
   ```bash
   php artisan key:generate
   ```

7. **Run database migrations**
   ```bash
   php artisan migrate
   ```

8. **Seed the database** (optional)
   ```bash
   php artisan db:seed
   ```

9. **Create storage link**
   ```bash
   php artisan storage:link
   ```

10. **Build assets**
    ```bash
    npm run production
    ```

## 🚀 Deployment

### Production Deployment

1. **Set environment to production**
   ```env
   APP_ENV=production
   APP_DEBUG=false
   ```

2. **Cache configuration**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

3. **Set proper permissions**
   ```bash
   chmod -R 755 storage/
   chmod -R 755 bootstrap/cache/
   ```

## 📚 API Documentation

The application includes a comprehensive REST API. You can find the Postman collection in:
- `FlutterEcommerceAPI.postman_collection.json`

### API Endpoints

- **Authentication**: `/api/v2/auth/*`
- **Products**: `/api/v2/products/*`
- **Orders**: `/api/v2/orders/*`
- **Categories**: `/api/v2/categories/*`
- **Sellers**: `/api/v2/sellers/*`

## 🔐 Security

- All sensitive data has been removed from this repository
- Environment variables are used for configuration
- CSRF protection enabled
- SQL injection protection
- XSS protection
- Rate limiting implemented

## 🌐 Multi-language Support

The application supports multiple languages through Laravel's localization system. Translation files are managed through the database.

## 💳 Payment Gateways

Supported payment methods:
- Credit/Debit Cards (Stripe)
- PayPal
- Razorpay (India)
- Paystack (Africa)
- Flutterwave
- Mobile Banking (Bkash, Nagad)
- Bank Transfer
- Cash on Delivery

## 📱 Mobile App Support

This backend supports mobile applications through comprehensive REST APIs.

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.

## 🆘 Support

For support and questions:
- Email: support@twoflip.com
- Website: https://twoflip.com

## 🔄 Updates

This project is actively maintained. Check the [releases](https://github.com/yasirraheel/edit.twoflip.com/releases) for the latest updates.

## 📊 Project Status

- ✅ **Active Development**
- ✅ **Production Ready**
- ✅ **Security Audited**
- ✅ **Performance Optimized**

---

**Built with ❤️ by the TwoFlip Team**
