# Image Guidelines for A&Y Portfolio

## Image Loading Strategy

### Low-Quality Image Placeholder (LQIP)
We implement LQIP using Cloudinary's blur transformation:
```html
<img 
    src="[...]/f_auto,q_auto,w_200,e_blur:1000/image.jpg"
    data-src="[...]/f_auto,q_auto,w_800/image.jpg"
>
```

### Cloudinary Transformations
Standard transformations used:

1. **Responsive Widths**
```
f_auto,q_auto,w_{width}
```
- Desktop: w_1200
- Tablet: w_800
- Mobile: w_400

2. **LQIP Transform**
```
f_auto,q_auto,w_200,e_blur:1000
```

### Implementation Example
```html
<picture>
    <source 
        srcset="[...]/f_auto,q_auto,w_1200/image.jpg"
        media="(min-width: 992px)"
    >
    <img 
        src="[...]/f_auto,q_auto,w_200,e_blur:1000/image.jpg"
        data-src="[...]/f_auto,q_auto,w_800/image.jpg"
        loading="lazy"
        width="800"
        height="600"
        alt="Description"
    >
</picture>
```

## Best Practices
1. Always specify width/height attributes
2. Use meaningful alt text
3. Implement lazy loading
4. Use LQIP for faster perceived loading
5. Leverage Cloudinary's automatic optimizations