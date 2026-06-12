output "bucket_id" {
  description = "Created S3 bucket ID."
  value       = aws_s3_bucket.this.id
}

output "bucket_arn" {
  description = "Created S3 bucket ARN."
  value       = aws_s3_bucket.this.arn
}

output "bucket_name" {
  description = "Created S3 bucket name."
  value       = aws_s3_bucket.this.bucket
}
