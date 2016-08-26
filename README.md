Web interface for managing bluetooth beacon data. Includes a very simple read-only JSON API that can be used by clients (phones, tablets, AR/VR devices..) to synchronize their local state.

In addition, the server-side part of a local service discovery mechanism is included (discovery.php). It should be started in the background at bootup, e.g. by adding the line

```php5 /path/to/discovery.php &
```

to `/etc/rc.local` or by creating a systemd `.service` file.

Before using, consider adjusting your webserver configuration to limit access to all files except `/json.php` e.g. to localhost or to clients that authenticated themselves one way or another.
