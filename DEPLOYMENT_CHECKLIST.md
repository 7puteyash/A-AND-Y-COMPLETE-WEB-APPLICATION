# PRODUCTION DEPLOYMENT CHECKLIST

## CRITICAL - Fix Before Deploy:

1. **Remove Hardcoded Credentials**
   - Move email credentials to environment variables
   - Change default admin password immediately
   - Use production database credentials

2. **Create Environment Configuration**
   - Copy .env.example to .env
   - Set production values in .env file
   - Update all config files to use $_ENV variables

3. **Security Hardening**
   - Enable HTTPS only
   - Add CSRF protection to forms
   - Implement rate limiting
   - Remove debug output
   - Secure file permissions

4. **Database Security**
   - Change database password
   - Create dedicated database user (not root)
   - Backup current data

5. **Email Configuration**
   - Set up production SMTP server
   - Use environment variables for credentials
   - Test email functionality

## RECOMMENDED IMPROVEMENTS:

6. **Performance**
   - Enable PHP OPcache
   - Compress assets
   - Set up CDN for static files

7. **Monitoring**
   - Set up error logging
   - Implement health checks
   - Add monitoring alerts

8. **Backup Strategy**
   - Database backup schedule
   - File backup plan
   - Recovery testing

## TESTING REQUIRED:

9. **Pre-deployment Testing**
   - Test all forms with real data
   - Verify email sending works
   - Check all page navigation
   - Test on production-like environment

10. **Post-deployment Verification**
    - SSL certificate working
    - All pages load correctly
    - Contact forms submit successfully
    - Admin login functional
