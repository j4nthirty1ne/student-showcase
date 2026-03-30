# 🧑‍💻 Git Collaboration Flow for Team

Simple step-by-step guide for collaborating on the Student Project Showcase.

---

## 📊 The Team Workflow

```
main branch
    ↓
[Create your branch]
    ↓
[Make changes & commit]
    ↓
[Push to GitHub]
    ↓
[Create Pull Request]
    ↓
[Team reviews]
    ↓
[Merge to main]
    ↓
[Pull latest main]
```

---

## 🚀 Step-by-Step Commands

### STEP 1: Start Fresh (Pull Latest Main)
```bash
git checkout main
git pull origin main
```

### STEP 2: Create Your Branch
Name your branch based on what you're doing:
```bash
git checkout -b feature/your-feature-name
```

**Examples:**
```bash
git checkout -b feature/add-authentication
git checkout -b bugfix/navbar-styling
git checkout -b feature/student-dashboard
```

### STEP 3: Make Your Changes
Edit files in your code editor. Then stage and commit:

```bash
git status                           # See what changed
git add .                            # Stage all changes
git commit -m "Describe your change"  # Create commit
```

**Good commit messages:**
- Clear & descriptive
- Start with a verb: "Add", "Fix", "Update"
- Example: `"Add login form to student dashboard"`

### STEP 4: Push Your Branch to GitHub
```bash
git push origin feature/your-feature-name
```

### STEP 5: Create a Pull Request on GitHub

1. Go to: https://github.com/j4nthirty1ne/student-showcase
2. You'll see a **"Compare & pull request"** button → Click it
3. Fill in:
   - **Title:** `Add login form to student dashboard`
   - **Description:** What did you change? Why?
4. Click **"Create Pull Request"**

**Simple PR Description Template:**
```
## What I Changed
- Added login form
- Added authentication validation

## How to Test
1. Go to /login
2. Try logging in with test credentials
3. Should redirect to dashboard

## Related Issue
Closes #5
```

### STEP 6: Team Reviews Your PR

Your team will review on GitHub:
- They'll add comments/suggestions
- They'll approve ✅ or request changes

**If Changes Requested:**
```bash
# Make the changes locally
git add .
git commit -m "Address review feedback"
git push origin feature/your-feature-name
# PR automatically updates!
```

### STEP 7: Merge to Main

After approval, either:
- **You merge:** Click **"Merge pull request"** button on GitHub
- **Or reviewer merges:** They'll merge it for you

### STEP 8: Clean Up

After merge, delete your branch locally:
```bash
git checkout main
git pull origin main
git branch -d feature/your-feature-name
```

---

## 📋 Quick Reference

### Check branches
```bash
git branch          # See all your local branches
```

### See what you changed
```bash
git status          # What files changed?
git diff            # What exactly changed?
```

### View commit history
```bash
git log --oneline   # See all your commits
```

### Undo changes (before commit)
```bash
git restore file.php  # Undo changes in one file
```

### Start over (if you messed up)
```bash
git checkout main             # Go back to main
git pull origin main          # Get latest
git branch -D wrong-branch    # Delete your branch
# Then start again from STEP 1
```

---

## 👥 Team Best Practices

✅ **DO THIS:**
- Always pull main before creating a branch
- Push frequently (don't work offline for weeks)
- Make small commits, not giant ones
- Write clear commit messages
- Test your code before pushing
- Ask for reviews
- Keep PR descriptions clear

❌ **DON'T DO THIS:**
- Push straight to main ⛔
- Make commits like "fix" or "stuff" ⛔
- Push untested code ⛔
- Huge PRs with 50 files changed ⛔
- Merge your own PRs without review ⛔

---

## 🔄 Real Example

```bash
# Your task: Add a search feature to projects

# STEP 1: Update main
git checkout main
git pull origin main

# STEP 2: Create branch
git checkout -b feature/project-search

# STEP 3: Make changes
# [Edit files in VS Code]
git add .
git commit -m "Add project search functionality"

# STEP 4: Push
git push origin feature/project-search

# STEP 5-7: Create PR on GitHub → Team reviews → Merge

# STEP 8: Clean up
git checkout main
git pull origin main
git branch -d feature/project-search

# ✅ Done! Ready for next task
```

---

## 🆘 Quick Fixes

**"My branch is behind"**
```bash
git pull origin main
```

**"I committed to main by mistake 😱"**
```bash
git reset --soft HEAD~1
git checkout -b feature/my-feature
git push origin feature/my-feature
```

**"Merge conflict! What do I do?"**
1. Open the conflicted file
2. You'll see: `<<<<<<` (your code) and `>>>>>>` (other code)
3. Pick which one you want, delete the markers
4. Save, then: `git add . && git commit -m "Resolve merge conflict" && git push`

**"I want to see what I changed"**
```bash
git diff
```

---

## 📞 Need Help?

Ask your team in Slack or create an issue in GitHub if you're stuck!

---

## Repository
🔗 https://github.com/j4nthirty1ne/student-showcase
