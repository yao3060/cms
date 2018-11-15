# Readme

## [Adding a remote](https://help.github.com/articles/adding-a-remote/)
```
git remote add origin https://github.com/user/repo.git
# Set a new remote
git remote -v
# Verify new remote
origin  https://github.com/user/repo.git (fetch)
origin  https://github.com/user/repo.git (push)
```

## Troubleshooting
You may encounter these errors when trying to add a remote.

### Remote name already exists
This error means you've tried to add a remote with a name that already exists in your local repository:

```
git remote add origin https://github.com/octocat/Spoon-Knife
fatal: remote origin already exists.
```

To fix this, you can

Use a different name for the new remote
Rename the existing remote
Delete the existing remote
