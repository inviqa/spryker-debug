Workspace
=========

The workspace class is a simple filesystem abstraction which you can use to
temporarily store files for tests.

The idea is that you have a directory `tests/Workspace` which is ignored in
`.gitignore`:

```
# .gitignore
/tests/Workspace
```

You then create a service or factory method to create the workspace

```php
$workspace = new Workspace($workspaceDirectory);
```

You can then reset the workspace before each test:
and access retrieve paths relative to the workspace:

```
$workspace->path('relative/to/workspace'); // returns absolute path
```


