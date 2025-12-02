# Push helper for Windows PowerShell
# Usage: open PowerShell in project root and run: .\scripts\push_to_github.ps1
# This script helps initialize a git repo (if needed), commit changes and push to a GitHub remote.
# It will NOT store your Personal Access Token (PAT) in this file. If you want to use PAT in remote URL,
# you'll be prompted to paste it (copy-paste) when asked; prefer Git Credential Manager instead.

param()

function Exec([string]$cmd) {
    Write-Host "=> $cmd" -ForegroundColor Cyan
    iex $cmd
}

# Ensure git is available
if (-not (Get-Command git -ErrorAction SilentlyContinue)) {
    Write-Error "Git not found in PATH. Install Git for Windows (https://git-scm.com/) or use Laragon's terminal." ; exit 1
}

$cwd = Get-Location
Write-Host "Working directory: $cwd"

# init repo if needed
if (-not (Test-Path .git)) {
    Write-Host "No git repo found — initializing..."
    Exec 'git init'
} else {
    Write-Host "Git repo already initialized."
}

# Set default branch to main if not set
$defaultBranch = 'main'
# Check if branch exists
$branches = git branch --list | ForEach-Object { $_.Trim() }
if (-not ($branches -contains $defaultBranch)) {
    Write-Host "Setting current branch to $defaultBranch (if not present)."
    Exec "git checkout -b $defaultBranch"
}

# Stage files
Exec 'git add -A'

# Commit
$commitMessage = Read-Host 'Commit message (enter to use default)'
if ([string]::IsNullOrWhiteSpace($commitMessage)) { $commitMessage = 'Initial commit' }
Exec "git commit -m \"$commitMessage\"" | Out-Null

# Remote
$remotes = git remote
if (-not $remotes) {
    Write-Host "No remote found. You need to create a GitHub repository first."
    Write-Host "If you already created a repo on GitHub, paste its HTTPS clone URL here (e.g. https://github.com/username/repo.git)."
    $remoteUrl = Read-Host 'GitHub repo HTTPS URL (leave blank to skip pushing)'
    if (-not [string]::IsNullOrWhiteSpace($remoteUrl)) {
        Exec "git remote add origin $remoteUrl"
    } else {
        Write-Host "Skipping push because no remote provided." ; exit 0
    }
} else {
    Write-Host "Existing remote(s):"; git remote -v
}

# Push
Write-Host "About to push to origin/$defaultBranch. If authentication is required, use your GitHub credentials or PAT."
try {
    Exec "git push -u origin $defaultBranch"
    Write-Host "Push completed." -ForegroundColor Green
} catch {
    Write-Warning "Push failed. You may need to authenticate. If you prefer, create a repo on GitHub and use a Personal Access Token (PAT)."
    Write-Host "To push using PAT in URL (not recommended to store in files), use remote like: https://<USER>:<PAT>@github.com/<USER>/<REPO>.git"
}

Write-Host "Done."