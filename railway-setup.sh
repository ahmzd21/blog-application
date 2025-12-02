#!/bin/bash

# Railway Deployment Quick Start Script
# This script helps you prepare your Laravel app for Railway deployment

echo "🚀 Railway Deployment Setup"
echo "============================"
echo ""

# Check if git is initialized
if [ ! -d .git ]; then
    echo "📦 Initializing Git repository..."
    git init
    git add .
    git commit -m "Initial commit - Laravel Blog Application"
    echo "✅ Git repository initialized"
else
    echo "✅ Git repository already exists"
fi

echo ""
echo "📋 Next Steps:"
echo ""
echo "1. Create a GitHub repository:"
echo "   → Go to https://github.com/new"
echo "   → Name it 'markdown-editor' (or your preferred name)"
echo "   → Don't initialize with README"
echo ""
echo "2. Push to GitHub:"
echo "   git remote add origin <your-github-repo-url>"
echo "   git branch -M main"
echo "   git push -u origin main"
echo ""
echo "3. Deploy on Railway:"
echo "   → Go to https://railway.app"
echo "   → Login with GitHub"
echo "   → New Project → Deploy from GitHub repo"
echo "   → Select your repository"
echo ""
echo "4. Configure Environment Variables in Railway:"
echo "   APP_KEY=base64:dJftxMxt04XbjBtvwfre09An7FNs9LkPZOhpMhfj5Bk="
echo "   APP_ENV=production"
echo "   APP_DEBUG=false"
echo "   DB_CONNECTION=sqlite"
echo "   DB_DATABASE=/app/database/database.sqlite"
echo "   SESSION_DRIVER=file"
echo "   QUEUE_CONNECTION=sync"
echo ""
echo "📖 Full guide: .gemini/antigravity/brain/cdad62ea-fda3-4154-a0a4-c5db5c232488/implementation_plan.md"
echo ""
echo "✨ Configuration files created:"
echo "   ✓ Procfile"
echo "   ✓ nixpacks.toml"
echo ""
