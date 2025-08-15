# Deployment Guide for InfinityFree

This guide explains how to deploy the A&Y Digital Marketing Agency website to InfinityFree hosting.

## 1. Creating an InfinityFree Account

1. Go to [InfinityFree](https://infinityfree.net/) and sign up for a free account
2. After verification, create a new hosting account
3. Note down your:
   - Control Panel URL
   - FTP Hostname
   - FTP Username
   - FTP Password

## 2. Database Setup

1. Access phpMyAdmin from your InfinityFree control panel
2. Create a new database (note down the name)
3. Import your database:
   - Go to the "Import" tab
   - Choose `sql/schema.sql` file
   - Click "Go" to import

## 3. Configure GitHub Secrets

Add these secrets to your GitHub repository:
- `FTP_HOST`: Your InfinityFree FTP hostname
- `FTP_USER`: Your FTP username
- `FTP_PASS`: Your FTP password
- `FTP_PATH`: Path to your web directory (usually `/htdocs/`)

## 4. Environment Configuration

1. Create `.env` file in your server's root directory:
```env
DB_HOST=localhost
DB_NAME=your_database_name
DB_USER=your_database_user
DB_PASS=your_database_password
BASE_URL=your_infinityfree_domain
```

2. Update configuration:
   - Set `BASE_URL` to your InfinityFree domain
   - Update database credentials

## 5. Common Issues and Fixes

### 500 Internal Server Error
- Check error logs in InfinityFree control panel
- Verify `.htaccess` file is uploaded
- Ensure file permissions are set to 644 for files and 755 for directories

### Database Connection Issues
- Verify PDO MySQL extension is enabled
- Double-check database credentials
- Use the correct database hostname (usually 'localhost')

### Missing Files
- Ensure all required files are uploaded
- Check file permissions
- Verify paths in include statements

## 6. Deployment Process

1. Push your changes to GitHub
2. Go to "Actions" tab in your repository
3. Select "Deploy via FTP" workflow
4. Click "Run workflow"
5. Choose environment (staging/prod)
6. Monitor deployment progress

## 7. Post-Deployment Verification

1. Visit your website URL
2. Test all main functionality
3. Check error logs for any issues
4. Verify database connections
5. Test contact form submission

For support, check InfinityFree's documentation or create an issue in the repository.
