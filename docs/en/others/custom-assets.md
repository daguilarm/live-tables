# Custom Assets 

You can send `Javascript` code from any view to the main container in order to be located correctly.

In the main container, a storage group is defined:

```html
<!-- Your custom Javascript -->
<script>
    @stack('live-tables-javascript')
</script>
```

So you can send your code directly there from any view.
